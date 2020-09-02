       
    $(document).ready(function () {
      var count=0;
         $(document).on("click",'.add-Row',function(){
             var table=$(this).parents("table");
          var cell1="<td><div class='form-group'><input type='number' class='form-control ' min='0'> </div> </td>";
            var cell2="<td><div class='form-group'><input type='number' class='form-control ' min='0'> </div> </td>";
            
            
            
             var cell3="<td> <p><button id='upload_button' class='upload_btn'>تحميل ملف ...</button></p><p><input  id='upload_input' name='your_name' type='file'/></p></td>";
              var cell4="<td><div class='form-group'><input type='date' class='form-control ' min='0'> </div> </td>";
               var cell6="<td>  <input type='button' class='done-crepto changeColor' value='تم'/></td>";
        
            var row="<tr>"+ cell1 + cell2 + cell3 + cell4 +cell6+"</tr>";
            table.append(row);
           var button = document.getElementById('upload_button');
            $(button).attr("id","id_" + count);
            var input  = document.getElementById('upload_input');
           $(input).attr("id","id_" + count);
count=count+1;
input.style.display = 'none';
button.style.display = 'initial';

button.addEventListener('click', function (e) {
    e.preventDefault();
    
    input.click();
});

input.addEventListener('change', function () {
   button.innerText = this.value; 
});
           
       });
        
      
     
        
        
        
        
        
        
        
              var count2=0;
         $(document).on("click",'.add-Row2',function(){
             var table=$(this).parents("table");
          var cell1="<td><div class='form-group'><input type='number' class='form-control ' min='0'> </div> </td>";
            var cell2="<td><div class='form-group'><input type='number' class='form-control ' min='0'> </div> </td>";
            
            
            
             var cell3="<td> <p><button id='upload_button2' class='upload_btn'>تحميل ملف ...</button></p><p><input  id='upload_input2' name='your_name' type='file'/></p></td>";
              var cell4="<td><div class='form-group'><input type='date' class='form-control ' min='0'> </div> </td>";
             
              var cell6="<td>  <input type='button' class='done-crepto changeColor' value='تم'  /></td>";
            var row="<tr>"+ cell1 + cell2 + cell3 + cell4 +cell6+"</tr>";
             
            table.append(row);
           var button2 = document.getElementById('upload_button2');
            $(button2).attr("id","id_" + count2);
            var input2  = document.getElementById('upload_input2');
           $(input2).attr("id","id_" + count2);
count2=count2+1;
input2.style.display = 'none';
button2.style.display = 'initial';

button2.addEventListener('click', function (e) {
    e.preventDefault();
    
    input2.click();
});

input2.addEventListener('change', function () {
   button2.innerText = this.value; 
});
             
             
             
             
             
             /**/
             
           
       });
    
        
          $(document).on("click",'.done-crepto',function()  
       {
              
           if($(this).val()=="تم")
               {
                 $(this).closest('tr').find(":input:not(:last)").attr('disabled',!this.checked);
           $(this).prop('value', 'تعديل').removeClass("changeColor");
             
               } else if($(this).val()=="تعديل")
            {
                $(this).closest('tr').find(":input:not(:last)").attr('disabled',this.checked);
           $(this).prop('value', 'تم').addClass("changeColor");
            }
           
       });
        
      
        
//        function toggleText(button_id) 
//{
//   var el = document.getElementsByClassName("edit-crepto");
//   if (el.firstChild.data == "Lock") 
//   {
//       el.firstChild.data = "Unlock";
//   }
//   else 
//   {
//     el.firstChild.data = "Lock";
//   }
//}
	});