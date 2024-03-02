import serial, MySQLdb, time, string

ser = serial.Serial('COM3', 9600)
dBConn = MySQLdb.connect("localhost", "root", "", "assignment_2") or die ("Cannot connect Database")
print(dBConn)

while True:
    data = ser.readline().decode('utf-8').rstrip()
    if(data):
            datasplit = data.split(',')
            humidity = datasplit[0].strip('<')
            temp = datasplit[1]
            faren = datasplit[2]
            analogValue = datasplit[3].strip('>')
            print("Humidity:", humidity)
            print("Temperature (Celsius):", temp)
            print("Temperature (Fahrenheit):", faren)
            print("Light Value:", analogValue)
           
            try:
                cursor = dBConn.cursor()
                cursor.execute("INSERT INTO humidity (degree) VALUES (%s)", (humidity,))
                cursor.execute("INSERT INTO temperature (Celcius, Fahrenheit) VALUES (%s, %s)", (temp, faren))
                cursor.execute("INSERT INTO light (lumen) VALUES (%s)", (analogValue,))
                dBConn.commit()
                cursor.close()
                print("Data inserted into the database.")
                time.sleep(3)
            except MySQLdb.Error as e:
                print(f"Error inserting data into MySQL database: {e}")