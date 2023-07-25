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
        let upC = null
        let dnC = null
        forFirst = 0
        forSecond = 0

        //Получаю таблицу в массиве
        let data = Array.prototype.map.call(document.querySelectorAll('#table tr'), function(tr) {
            return Array.prototype.map.call(tr.querySelectorAll('td'), function(td) {
                return td.innerHTML;
            })
        })
        console.log(data)
        //прохожусь по каждой ячейке 
        for(let i = 0; i < 5; i++){
          for(let f = 0; f < 5; f++){
            if(data[i][f] == 0){
          // Получаю значение строки(той же, выше\ниже)

          //Задаю значение внутри для сброса предыдущего значения
              let upCell = null
              let dnCell = null
              let lCell = null
              let rCell = null

              //Задаю "координаты" для верхнего\нижнего и правого\левого положения, не через инкремент\декремент, 
              //т.к. JS осуществляет его для i и f(а это не нужно)
              upR = i - 1
              dnR = i + 1
              rC = f + 1
              lC = f - 1

              //Проверяю на undefined при помощи оператора необязательной цепочки вызовов, чтобы не выдавал ошибку, если же значения нет, то null, 
              //чтобы sidesSum корректно работал и не выдавал NaN
              dnCell = data[dnR]?.[f] ?? null
              upCell = data[upR]?.[f] ?? null
              lCell = data[i]?.[lC] ?? null
              rCell = data[i]?.[rC] ?? null
              //Суммирую результат полученных значений  с преобразованием в число
              sidesSum = Number(upCell) +Number(dnCell) +Number(lCell) +Number(rCell)

              // //Проверяю результат на соответствие условию
              if(sidesSum >= 2){ ++sum}
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