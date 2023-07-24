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
      <?php for($i = 0; $i<5; $i++) {?>
        <tr>
        <?php for($j = 0; $j<5; $j++) {?>
        <td class="td"> <?php echo rand(0, 1);?> </td>
        <?php } ?>
        </tr>
      <?php }?> 
    </table>

    <script>
      var t = document.querySelector('#table') //берем таблицу 
      var tra = t.children //получаем каждую строку по отдельности в массиве
      var tds = null
      var sum = 0
      var td = t.querySelectorAll(".td")
      var sidesSum = 0
      //Здесь пока что не все получилось, т.к. previousElementSibling и тд возвращает объект, хотя теоретически должен вернуть значение ячейки 
      function sumAll(){
        // Вызов функции смены цвета
        self.changeColor()
        //прохожусь по таблице
        for (var i=0; i<t.length; i++)  {
          //получаю все элементы текущей строки в массиве
            tds = t[i].children;
            //прохожусь по каждому элементу
            for (var n=0; n<tds.length;n++)  {

                //Далее возникла загвоздка, т.к. у меня не получается обратиться  к элементам таблицы. 
                //Вроде как(судя по док-ии и форумам) это делает (next\previous)Sibling, однако они это делают справа\слева, но не сверху\снизу
                //Теоретически можно было бы раздать всем тэгам td id-шники, но это нецелесообразный подход и я уверен, есть решение лучше
                
                //Прохожу по каждой ячейке строки tds
                for(let elem of tds){
                  var upper = elem.previousSibling;
                  var down = elem.nextSibling;
  
                  //суммирую результат,т.к. если он больше 2, то есть подходящая условию ячейка
                  sidesSum = upper + down

                  //проверяю выполнение условия
                  if(sidesSum>2) sum++;
                }
            }
        }
        
        //Вывожу результат
        alert('Количество ячеек с нулями имеют больше 2 ячеек с 1: ' + sum);
      }

      function changeColor(){
        for(let a of td){
          a.style.background = "yellow"
        }
      }

    </script>
 </body>
</html>