#include <stdio.h>

int main (int argc, char **argv){

   if (argc != 5){
      printf("Invalid number of parameters!!\n\n");
   }
   else {
      // printf ("This is not a real email system, this email will NOT be delivered\n");
      // printf ("and is intended for testing purposes ONLY!\n\n");

      // TO STUDENTS: If you actually want to learn how to send a SMTP email using plain C
      // programming take the exam in PG3401 (the C programming course I teach at Kristiania),
      // it might just be an exam assignment there ;-)

      printf ("\nEmail sent to %s\n\n", argv[2]);

   }

   return 0;
}
