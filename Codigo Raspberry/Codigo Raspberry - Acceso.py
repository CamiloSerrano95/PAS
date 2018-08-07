import serial
import pymysql
import time
from datetime import *

arduino = serial.Serial('/dev/ttyACM1', baudrate=9600)
conn = pymysql.connect(host="localhost", user="root", passwd="123456", db="RFID")

while True:
  line = arduino.readline()
  line = line.strip()
  print (line)
  print(len(line))

  if len(str(line)) > 0:
    myCursor = conn.cursor()
    
    try:
      myCursor.execute("SELECT * FROM Profesores WHERE IdTarjeta='"+line+"'")
    except Exception as e:
      print (e.message)

    results = myCursor.fetchall()
    fechaHoy = str(datetime.today())
    
    print (results)
    
    for row in results:
      print ("ID Tarjeta " + row[0])
      print ("Cedula " + row[1])
      print ("Nombres " + row[2])
      print ("Apellidos " + row[3])

    Mensaje = "El profesor " + row[2] + " " + row[3] + " abrio la puerta"
    myCursor.execute("INSERT INTO Reporte(IdTarjeta,IdProfesor,Nombres,Apellidos,Mensaje,Fecha,Estado) VALUES('"+row[0]+"','"+row[1]+"','"+row[2]+"','"+row[3]+"','"+Mensaje+"','"+fechaHoy+"','0');")
    conn.commit()
    
    if line == row[0]:
      print ("Activando el motor")
      arduino.write('A')
    else:
      print ("No se puede entrar")
