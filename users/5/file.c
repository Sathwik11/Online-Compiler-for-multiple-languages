#include<stdio.h>
#include<string.h>
main()
{
int i,n;
char *x="lapy";
n=strlen(x);
for(i=0;i<n;i++)
{
printf("%s",x);
x++;
}
}