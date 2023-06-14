## Judul Project

**Keamanan Kost**

## Deskripsi Project

Projek ini dibuat bertujuan untuk mengembangkan alat keamanan kost dengan menggunakan IOT (Internet Of Things). Sistem ini diterapkan pada pintu masuk dengan menggunakan kartu RFID, dimana sebelum memasuki kost penghuni kost harus menyiapkan kartu RFID yang sudah terdaftar pada sistem database kost kemudian discannkan ke alat yang terpasang pada pintu masuk kost sehingga pintu akan terbuka secara otomatis dan akan menutup kembali ketika penghuni kost sudah memasuki pintu masuk kost.

## Rangkaian Project
| ESP8266 | Komponen    |
| :---:   | :---: |
| GND |  GND Sensor Ultrasonik, GND Servo, GND Sensor DS18B20, GND Relay 5V, GND LCD 16x2 I2C, GND Buzzer |
| 5V   | VCC Sensor Ultrasonik, VCC Servo, VCC Sensor DS18B20, VCC Relay 5V, VCC LCD 16x2 I2C |
| IO23   | TRIG PIN Sensor Ultrasonik |
| IO19   | ECHO PIN Sensor Ultrasonik |
| IO18   | PWM PIN Servo |
| IO14   | DQ PIN Sensor DS18B20 |
| IO17   | IN PIN Relay 5V |
| IO16   | BZ_1 PIN Buzzer |
| IO22   | SCL PIN LCD 16x2 I2C |
| IO21  | SDA PIN LCD 16x2 I2C |

## Fitur Utama

1. **Scan RFID Card Pada Pintu Masuk:** Fitur ini menggunakan sensor RFID untuk memindai kartu milik anggota kost / penghuni kost. Jika kartu RFID yang dimiliki anggota kost sudah terdaftar pada sistem maka gerbang kost akan terbuka, jika kartu belum terdaftar maka gerbang tidak akan terbuka.
2. **Kelola Anggota Kost:** Sistem ini memungkinkan admin / pemilik kost untuk mendata anggota kost kemudian mendaftarkan Kode Kartu RFID ke dalam sistem database.
3. **Monitoring Data Masuk Kost:** Sistem ini memungkinkan admin / pemilik kost untuk melihat siapa saja yang memasuki kost setelah melakukan scan kartu.

## Teknologi Yang Digunakan

- **Bahasa pemrograman:** Php, JavaScript, C++, SQL
- **Mikrokontroller:** ESP8266
- **Protokol IoT:** HTTP
- **Database:** MySQl
- **Komponen:** Sensor Ultrasonik HC-SR04, Sensor RFID, Servo, LCD 16x2 I2C
