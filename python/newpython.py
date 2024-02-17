import serial
import mysql.connector

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="miniproject"
)
mycursor = mydb.cursor()

pin = serial.Serial('COM8', 9600)

flag = 0
data = ""
while True:
    value = pin.read().decode('ascii')

    if value == '*':
        flag = 1
    elif value == '#':
        flag = 0
        adp = data
        sql = "SELECT log_status FROM emp_logs WHERE Rf_id=%s AND log_id=(SELECT MAX(log_id) FROM emp_logs WHERE Rf_id=%s)"
        mycursor.execute(sql, (adp,adp))
        result = mycursor.fetchone()

        if result and result[0] == "IN":
            status = "OUT"
        elif result:
            status = "IN"
        else:
            status = "IN"
        sql = "INSERT INTO emp_logs (Rf_id,Log_status) VALUES (%s, %s)"
        val = (adp, status)
        mycursor.execute(sql, val)
        print("Your ID : ",adp," status : ", status)
        mydb.commit()
        data = ""
    if flag == 1:
        if value != '*' and value != '#':
            data += value
