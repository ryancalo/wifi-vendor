
<?php
require __DIR__ . '\autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

//class Epson {

   

  // public function connect()

    //{

      $connector = new NetworkPrintConnector("10.0.0.16", 9100);
      $printer = new Printer($connector);
      $printer -> initialize();
		/* Text */
	  $printer -> text("Test\n");
	  $printer -> cut();

	  $printer -> close();
      

    //}





   //public function printme($printer)

     //{
        
        

		//$printer -> initialize();
		/* Text */
		//$printer -> text('Test');
		//$printer -> cut();

		//$printer -> close();




     //}





//}



//$test = New Epson;

//$test->connect();













?>