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
      let t = document.querySelector('#table') //берем таблицу 
      let rows = document.querySelectorAll('tr')//получаю все строки
      let sum = 0
      let td = t.querySelectorAll(".td")
      let sidesSum = 0

      //Здесь пока что не все получилось, т.к. previousElementSibling и тд возвращает объект, хотя теоретически должен вернуть значение ячейки 
      function sumAll(){
        // Вызов функции смены цвета
        self.changeColor()
        let rowInd = 0
        let colInd = 0
        forFirst = 0
        forSecond = 0
        //прохожусь по каждой ячейке 
        for(let i; i < rows.length; i++){
          for(let f = 0; f < 5; f++){
            //проверяю содержимое на соответствие условию
            line = rows[i]
            cell = line[f]
            if(cell == 0){
              //Этап нахождения значения ячейки разбит на 2 переменные, т.к. иначе у меня выдавал ошибку undefined

              //Получаю значение строки(той же, выше\ниже)
              let upCell = rows[--i]?.textContent
              //Собираю полученное ранее значение в массив, чтобы обратиться к нему через []
              let upperRow = upCell?.split(' ')[f]
              
              let downCell = rows[++i]?.textContent
              let downRow = downCell?.split(' ')[f]

              let rightCell = rows[i]?.textContent
              let rightCol = rightCell?.split(' ')[++f]

              let leftCell = rows[i]?.textContent
              let leftCol = leftCell?.split(' ')[--f]

              //Суммирую результат полученных значений
              sidesSum = downRow + upperRow + rightCol + leftCol

              //Проверяю результат на соответствие условию
              if(sidesSum > 2){ ++sum}
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