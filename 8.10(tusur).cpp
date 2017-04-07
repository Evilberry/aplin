#include <QCoreApplication>
#include <iostream>
using namespace std;
int main()
{
    int array[5][5];
    for(int i = 0;i < 5;i++){
        for(int j = 0;j < 5;j++){
            array[i][j] = 1 + rand() % 3;
        }
    }
    //минимальное число
    int sum = 0,min=100,who;
    for(int i = 0;i < 5;i++){
        for(int j = 0;j < 5;j++){
            sum = sum + array[i][j];
        }
        if(sum < min){
            min = sum;
            who = i;
        }
        sum = 0;
    }
    cout << "Winner - " << who << endl;
    //system("pause");
    return 0;
}
