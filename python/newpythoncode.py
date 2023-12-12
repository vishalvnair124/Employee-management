import serial
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="miniproject"
)
mycursor = mydb.cursor()

pin = serial.Serial('COM7', 9600)

flag = 0
data = ""
while True:
    value = pin.read().decode('ascii')

    if value == '*':
        flag = 1
    elif value == '#':
        flag = 0
        print(data)
        raop= data.split(",")
        
        sql = "INSERT INTO emp_logs (Rf_id,Log_status) VALUES (%s, %s)"
        val = (raop[0], raop[1])
        mycursor.execute(sql, val)
        mydb.commit()
        data = ""
    if flag == 1:
        if value != '*' and value != '#':
            data += value
