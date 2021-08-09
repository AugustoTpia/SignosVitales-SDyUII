#include <SoftwareSerial.h>
SoftwareSerial BT1(10,11); // RX, TX recorder que se cruzan
int NTC = A0;
float val;
float temp;
String strFloat;
//char charFloat[6];
float tempC; 
char stempC;
boolean c = true;
int pulso = 0;

void setup(){
      pinMode(A3, INPUT);
       //BT1.flush();
       //delay(500);
       Serial.begin(9600);
       //Serial.println("Enter AT commands:");
       BT1.begin(38400);
       pinMode(NTC, INPUT);
       
   }

void loop(){
    pulso = analogRead(A3);
  
    if(BT1.available()){
      //Lee BT y envia a arduino
      stempC = BT1.read();
      Serial.write(stempC);
       if(stempC == 't'){
         val = analogRead(NTC);
         temp = Thermister(val);
         
             BT1.print(temp+1.0);
           
         
       }
    }

    delay(50);
    Serial.println(pulso);
   //strFloat = temp;
   //strFloat.toCharArray(charFloat, 6);
  
}

double Thermister(float RawADC){
  double Temp;
  Temp = log(((10240000/RawADC) - 10000));
  Temp = 1 / (0.001129148 + (0.000234125 + (0.0000000876741 * Temp * Temp )) * Temp);
  Temp = Temp - 273.15;
  return Temp;
}
