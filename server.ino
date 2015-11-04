
#include <SPI.h>
#include <Ethernet2.h>
long randNumber;
String json_data = "";
#include <ArduinoJson.h>
int state;
byte mac[] = {
  0x90, 0xA2, 0xDA, 0x0F, 0xFB, 0xBC
};                                       

EthernetClient client;
char server[] = "www.scottshuffler.me"; // IP Adres (or name) of server to dump data to

unsigned long interval = 20000; // Wait between dumps



void setup() {
  Serial.begin(9600);
  Ethernet.begin(mac);
  Serial.print("IP number assigned by DHCP is ");
  Serial.println(Ethernet.localIP());
  pinMode(8, OUTPUT);
  
  //randomSeed(analogRead(0));
}


void loop()
{
  
  delay(1000);
  if (client.connect(server, 80)) {
    Serial.println("connected");
    // Make a HTTP request:
    client.println("GET /coffee/currstate.php HTTP/1.1");
    client.println("Host: www.scottshuffler.me");
    //client.println("Connection: close");
    client.println();
  }
  else {
    // kf you didn't get a connection to the server:
    Serial.println("connection failed");
  }
  // if there are incoming bytes available
   //from the server, read them and print them:
//  while (client.available()) {
//    char c = client.read();
//    Serial.print(c);
//  }
json_data = "";
  while (client.available()) {
   char c = client.read();
     if (c == '{') {
       json_data += '{';
       c = client.read();
       while (c != '}' ) {
         if (c == '"'){
           //json_data += '\\';
         }
       json_data += c;
       c = client.read();
       }
       json_data += '}';
       
       parse_json();
       //client.stop();
     }
 }
  //gen_json(client);
  // if the server's disconnected, stop the client:
  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();

    // do nothing forevermore:
  }
  if (state == 1) {
      digitalWrite(8, HIGH);
  }
  else {
    digitalWrite(8, LOW);
  }
}


void parse_json()
{
  Serial.println("parse json");
   StaticJsonBuffer<200000> jsonBuffer;
 char json[2000];
 int json_length = json_data.length();
 for (int a=0;a<=json_length;a++)
   {
     json[a]=json_data[a];
     //Serial.print(json[a]);
   }
   JsonObject& root = jsonBuffer.parseObject(json);
  
    if (!root.success())
    {
      Serial.println("parseObject() failed");
      //return;
    }
    else
    {
    //
    // Step 3: Retrieve the values
    //
    state = root["state"];
    const char* username = root["username"];
    
    Serial.println(state);
    Serial.println(username);
  }
}


void gen_json(EthernetClient client_local)
{
  Serial.println("gen json");
  // if there are incoming bytes available 
 // from the server, read them and print them:
 
}


