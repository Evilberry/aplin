#include <stdlib.h>
#include "stdio.h"
#include "locale.h"

void check(int win){
    if(win == 1){
        printf("Ты выиграл\n\n1. Продолжить\n2. Завершить\n");
    }else{
        printf("Ты проиграл\n\n1. Продолжить\n2. Завершить\n");
    }
}
int check_user_input(int user_answer) {
    int bot_answer = 1 + rand() % 3;
    while(1){
        if(user_answer >= 1 && user_answer <= 3){
            if(user_answer == bot_answer){
                printf("Ничья\n\n1. Продолжить\n2. Завершить\n");
                return 3;
            }else{
                if(user_answer == 1 && bot_answer == 2){
                    check(1);
                    return 1;
                }
                if(user_answer == 1 && bot_answer == 3){
                    check(0);
                    return 0;
                }
                if(user_answer == 2 && bot_answer == 1){
                    check(0);
                    return 0;
                }
                if(user_answer == 2 && bot_answer == 3){
                    check(1);
                    return 1;
                }
                if(user_answer == 3 &&  bot_answer == 1){
                    check(0);
                    return 0;
                }
                if(user_answer == 3 && bot_answer == 2){
                    check(1);
                    return 1;
                }
            }
        }else{
            printf("Нет такой команды.\n1. Камень\n2. Ножницы\n3. Бумага\n");
            scanf("%i", &user_answer);
        }
    }
}
int main() {
    system("@cls||clear");
    int user_score = 0;
    int bot_score = 0;
    int x;
    setlocale(LC_ALL, "Russian");
    while(1){
        int end;
        printf("Ваш счет: %d Счет компьютера: %d \n", user_score, bot_score);
        printf("Сделай ход \n1. Камень\n2. Ножницы\n3. Бумага\n");
        scanf("%i", &x);
        int smth = check_user_input(x);
        if(smth == 0){
            bot_score += 1;
        }
        if(smth == 1){
            user_score += 1;
        }
        scanf("%i", &end);
        if(end == 2){
            break;
        }else{
            system("@cls||clear");
        }
    }
    return 0;
}
