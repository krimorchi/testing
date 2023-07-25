<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Тег table</title>
  </head>
  <body>
    
    <button onclick="changeColor()">Первая кнопка</button>
    <button onclick="sumAll()">Вторая кнопка</button>
    <button onclick="changeColor()">Третья кнопка</button>

    <!-- Заполнение таблицы 0 и 1 через цикл, пожно поменять как значения ячеек, так и их число -->
    <table border="1" id="table">
      <?php for($a = 0; $a<5; $a++) {?>
        <tr class="tr">
        <?php for($b = 0; $b<5; $b++) {?>
        <td class="td"> <?php echo rand(0, 1);?> </td>
        <?php } ?>
        </tr>
      <?php }?> 
    </table>

    <script>
      var t = document.querySelector('#table') //берем таблицу 
      var rows = document.querySelectorAll('tr')//получаю все строки
      var tra = t.children //получаем каждую строку по отдельности в массиве
      var tds = null
      var sum = 0
      var td = t.querySelectorAll(".td")
      var sidesSum = 0
      var nextCols = 0
      var prevCols = 0
      var prevCol = 0
      var nextCol = 0
      var rightCol = 0
      var leftCol = 0

      //Здесь пока что не все получилось, т.к. previousElementSibling и тд возвращает объект, хотя теоретически должен вернуть значение ячейки 
      function sumAll(){
        // Вызов функции смены цвета
        self.changeColor()
        //прохожусь по таблице
        // for (var a=0; a<t.length; a++)  {
        //   //получаю все элементы текущей строки в массиве
        //     tds = t[a].children;
        //     //прохожусь по каждому элементу
        //     // for (var b=0; b<tds.length;b++)  {

        //     //     //Далее возникла загвоздка, т.к. у меня не получается обратиться  к элементам таблицы. 
        //     //     //Вроде как(судя по док-ии и форумам) это делает (next\previous)Sibling, однако они это делают справа\слева, но не сверху\снизу
        //     //     //Теоретически можно было бы раздать всем тэгам td id-шники, но это нецелесообразный подход и я уверен, есть решение лучше
                
        //     //     //Прохожу по каждой ячейке строки tds
        //     //     for(let elem of tds){
        //     //       var upper = elem.previousSibling;
        //     //       var down = elem.nextSibling;
  
        //     //       //суммирую результат,т.к. если он больше 2, то есть подходящая условию ячейка
        //     //       sidesSum = upper + down

        //     //       //проверяю выполнение условия
        //     //       if(sidesSum>2) sum++;
        //         //   }
        //         // }
            
        //     }
        for (var d = 0; d < rows.length; d++) { // перебираем все строки
          let mainCols = rows[d].querySelectorAll('td')// получаем текущие столбцы

          //Проводим проверку на случай, если это первая или последняя строка
          if(d==0){
            d = d + 1
            nextCols = rows[d].querySelectorAll('td')// получаем следующие столбцы
          }else if( 0 < d < 5){ //$a
            d = d - 1
            prevCols = rows[d].querySelectorAll('td')// получаем предыдущие столбцы
            d = d+2
            nextCols = rows[d].querySelectorAll('td')// получаем следующие столбцы
          }else{
            d = d - 1
            prevCols = rows[d].querySelectorAll('td')// получаем предыдущие столбцы
          }
          
          for (var e = 0; e < mainCols.length; e++) { // перебираем все столбцы
            
            let mainCol = mainCols[e].textContent //берем текущую ячейку
            //Проводим проверку на случай, если первая\последняя стркоа и затем проверку, если первый или последний столбец и суммируем итог
            //Затем проверяем больше ли 2 сумма единиц в соседних ячейках
            if(mainCol == 0){
              if(d==0){
                nextCol = nextCols[e].textContent
                if(e==0){
                  let g = ++e
                  rightCol = mainCols[g].textContent
                  sumCols = nextCol + rightCol
                }else if(0 < e < 25){ // $a*$b
                  let f = --e
                  let g = ++e
                  leftCol = mainCols[f].textContent
                  rightCol = mainCols[g].textContent
                  sumCols = nextCol + rightCol + leftCol
                }else{
                  let f = --e
                  leftCol = mainCols[f].textContent
                  sumCols = nextCol + leftCol
                }
                if(sumCols >= 2) sum++
              }else if( 0 < d < 5){ // $a
                prevCol = prevCols[e].textContent
                nextCol = nextCols[e].textContent
                if(e==0){
                  let g = ++e
                  rightCol = mainCols[g].textContent
                  sumCols = nextCol + prevCol + rightCol
                }else if(0 < e < 25){ //$a*$b
                  let f = --e
                  let g = ++e
                  leftCol = mainCols[f].textContent
                  rightCol = mainCols[g].textContent
                  sumCols = nextCol + prevCol + rightCol + leftCol
                }else{
                  let f = --e
                  leftCol = mainCols[f].textContent
                  sumCols = nextCol + prevCol + leftCol
                }
                if(sumCols >= 2) sum++
              }else{
                prevCol = prevCols[e].textContent
                if(e==0){
                  let g = ++e
                  rightCol = mainCols[g].textContent
                  sumCols = prevCol + rightCol
                }else if(0 < e < 25){ //$a*$b
                  let f = --e
                  let g = ++e
                  leftCol = mainCols[f].textContent
                  rightCol = mainCols[g].textContent
                  sumCols = prevCol + rightCol + leftCol
                }else{
                  let f = --e
                  leftCol = mainCols[f].textContent
                  sumCols = prevCol + leftCol
                }
                if(sumCols >= 2) sum++
              }
            }
          }
        }
        
        //Вывожу результат
        alert('Количество ячеек с нулями имеют больше 2 ячеек с 1: ' + sum)
      }

      function changeColor(){
        for(let a of td){
          a.style.background = "yellow"
        }
      }

    </script>
 </body>
</html>