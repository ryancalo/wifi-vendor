import speedtest

def get_speed():

    try:
        speedtester = speedtest.Speedtest()
        speedtester.get_best_server()
        download = speedtester.download()
        upload = speedtester.upload()
        tmpD = bytesto(download, 'm')
        tmpU = bytesto(upload, 'm')
        speed =   str(round(tmpD, 2) ) + " / " + str( round(tmpU,2) ) +" MB/s"
        return speed
    except:
    	pass

def bytesto(bytes, to, bsize=1024):
    """convert bytes to megabytes, etc.
       sample code:
           print('mb= ' + str(bytesto(314575262000000, 'm')))
       sample output: 
           mb= 300002347.946
    """

    a = {'k' : 1, 'm': 2, 'g' : 3, 't' : 4, 'p' : 5, 'e' : 6 }
    r = float(bytes)
    for i in range(a[to]):
        r = r / bsize

    return(r)


speed = get_speed()
print(speed)

