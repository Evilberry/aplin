#include <QCoreApplication>
#include <iostream>
using namespace std;
int main()
{
    int N = 0;
    while (N == 0 || N < 0){
        cout << "Enter N" << endl;
        cin >> N;
    }
    int *array = new int[N];
    for(int i = 0; i <= N;i++){
        array[i] = rand();
        cout << array[i] << endl;
    }
    //четные номера
    for(int i = 0; i <= N;i++){
        if(i%2==0 && i != 0){
            cout << array[i] << endl;
        }
    }
    //сумма
    int sum;
    for(int i = 0; i <= N;i++){
        sum = array[i] + sum;
    }
    cout << "SYMMA = " << sum << endl;
    //сортировка
    for (int j=0; j<N; j++)
            for (int i=0; i<N-1; i++)
                if (array[i]<array[i+1])
                    swap(array[i],array[i+1]);


        for (int i=0; i<N; i++)
            cout << array[i]<<' ';
    delete [] array;
    return 0;
}

