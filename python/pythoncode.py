import serial
import time
import MySQLdb

mysq = MySQLdb.connect('localhost','root','', 'miniproject')
cur = mysq.cursor()

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
        
        sql = "INSERT INTO emp_logs (Rf_id,Log_status) VALUES ('%s', '%s')" % (str (raop[0]),str (raop[1]))
        cur.execute(sql)
        mysq.commit()
        data = ""
        
    if flag == 1:
        if value != '*' and value != '#':
            data+=value       
            
