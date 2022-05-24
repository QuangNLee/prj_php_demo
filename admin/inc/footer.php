 <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
        <p>
         &copy; Copyright. All Rights Reserved.
        </p>
    </div>
     <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
     <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
     <script type="text/javascript">
         $(document).ready(function(){
             statistical();
             let char = new Morris.Area({
                 element: 'myfirstchart',

                 xkey: 'date',

                 ykeys: ['order', 'salary', 'quantity'],

                 labels: ['Order', 'Salary', 'Quantity']
             });
             $('.select-date').onchange(function () {
                let time = $(this).val();
                if(time == '7days'){
                    var text = 'Last 7 days';
                } else if (time == '28days'){
                    var text = 'Last 28 days';
                } else if (time == '90days'){
                    var text = 'Last 90 days';
                } else {
                    var text = 'Last 365 days';
                }
                 $.ajax({
                     url:"../admin/statistical.php",
                     method:"POST",
                     dataType:"JSON",
                     data:{time:time},
                     success:function(data){
                         char.setData(data);
                         $('#text-date').text(text);
                     }
                 });
             })
             function statistical() {
                 let text = 'Last 7 days';
                 $('#text-date').text(text);
                 $.ajax({
                     url:"../admin/statistical.php",
                     method:"POST",
                     dataType:"JSON",
                     success:function(data){
                         char.setData(data);
                         $('#text-date').text(text);
                     }
                 });
             }
         });
     </script>
</body>
</html>
