
#include <SPI.h>
#include <Ethernet.h>

byte mac[]    = {  0xDE, 0xED, 0xAB, 0xFE, 0xFE, 0xED };
char address[] = "192.168.8.101";

IPAddress ip;
char galip[16];

EthernetClient client;

const int coinpin = 2;
const int redled = 4;
const int blueled = 6;
const int relay = 8;
int nextCheck = 1500;

String readString;

boolean triggerPrint = false;

void startEthernet(){
   client.stop();
   Serial.println("Connecting Device to network...");
   Serial.println();
   delay(1000);
   //Connect DHCP
   if (Ethernet.begin(mac) == 0)
     {
      Serial.println("DHCP failed, reset device to try again");
      Serial.println();
     }
   else
   {
    Serial.println("Device connected to network, device ip: ");
    Serial.println(Ethernet.localIP());
     ip = Ethernet.localIP();
     sprintf(galip, "%d.%d.%d.%d", ip[0], ip[1], ip[2], ip[3]);
   }
}

void initializing(){
      int counter=0;
      while(counter<36)
      {
        digitalWrite(blueled, LOW);
        digitalWrite(redled, HIGH);
        delay(100);
        digitalWrite(blueled, HIGH);
        digitalWrite(redled, LOW);
        delay(100);
        counter=counter+1;
      }
      counter=0;
  }

void setup() {
  Serial.begin(9600);
  attachInterrupt(coinpin, coinInterrupt, RISING);
  pinMode(redled, OUTPUT);
  pinMode(blueled, OUTPUT);
  pinMode(relay, OUTPUT);

  digitalWrite(relay, HIGH);
  startEthernet();
  initializing();
  checkConnection();
}

void loop() {
  if ( nextCheck == 0 ){
    checkConnection();
    nextCheck= 1500;
  }else{
    nextCheck--;
  }
  
  if(triggerPrint){
    Serial.println("Trigger print function.");
    triggerPrint = false;
    printVoucher();
  }
  delay(10);
}

void coinInterrupt(){
  delay(500);
  Serial.println("recieving coin drop.");
  triggerPrint = true;
}

void checkConnection(){
   const String param = "booth_token=SDFAJSdlasdALKD&galileo_ip=" + String(galip);
   
   if(client.connect(address, 80)){
      client.print("POST /galileo/check_peripherals/");
      client.println(" HTTP/1.1");
      client.print("Host: ");
      client.println(address);
      client.println("User-Agent: Galileo/1.0");
      client.println("Connection: close");
      client.println("Content-Type: application/x-www-form-urlencoded;");
      client.print("Content-Length: ");
      client.println(param.length());
      client.println();
      client.println(param); 

     if (client.connected()){
        Serial.println("Checking Connection...");
        int responseLine = 0;
        while (client.connected()) {
          if(client.available()){
            char c = client.read();
            if (readString.length() < 200) {
              if ( responseLine == 12) {
                if (c == '1'){
                  Serial.println("Connected...");
                  digitalWrite(redled, LOW);
                  digitalWrite(blueled, HIGH);
                  digitalWrite(relay, LOW);
                  client.stop();
                  responseLine = 0;
                }else if(c == '0'){
                  Serial.println("Connection Failed...");
                  digitalWrite(blueled, LOW);
                  digitalWrite(redled, HIGH);
                  client.stop();
                  responseLine = 0;
                }else{
                  Serial.println("Reading response line " + String(responseLine) );
                }
              }
            }else{
              client.stop();
            }
            if (c == '\n') {
             responseLine++;                            
            } 
          }         
        }
        client.stop();
     }else{
      Serial.println("Can't send post.");
      digitalWrite(relay, HIGH);
      client.stop();
     }
   }else{
      Serial.println("Client is not connected.");
      digitalWrite(relay, HIGH);
      client.stop();
   }
}



void printVoucher(){
   const String param = "action=printvoucher&booth_token=SDFAJSdlasdALKD&galileoip=" + String(galip);
   digitalWrite(relay, HIGH);
   
   if(client.connect(address, 80)){
      client.print("POST /galileo/print_voucher/");
      client.println(" HTTP/1.1");
      client.print("Host: ");
      client.println(address);
      client.println("User-Agent: Galileo/1.0");
      client.println("Connection: close");
      client.println("Content-Type: application/x-www-form-urlencoded;");
      client.print("Content-Length: ");
      client.println(param.length());
      client.println();
      client.println(param); 

      int blinkTimes = 24;
      while(blinkTimes > 0)
      {
        digitalWrite(blueled, LOW);
        delay(50);
        digitalWrite(redled, HIGH);
        delay(50);
        blinkTimes--;
      }
      blinkTimes = 24;

     if (client.connected()){
        Serial.println("Printing voucher...");
        int responseLine = 0;
        while (client.connected()) {
          if(client.available()){
            Serial.println("Printed..");
            client.stop();
          }
        }
        client.stop();
     }else{
      Serial.println("Can't send post.");
      digitalWrite(relay, HIGH);
      client.stop();
     }
   }else{
      Serial.println("Client is not connected.");
      digitalWrite(relay, HIGH);
      client.stop();
   }

   digitalWrite(relay, LOW);
}
