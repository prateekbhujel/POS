    </div>
    <footer>
	<center class="my-5">Created by <a target="_blank" href="https://www.twitter.com/prateekbhujel" class="link-success">Pratik Bhujel</a> © <?=date('Y')?> . All Rights and Services.</center>
</footer>
</body>

    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- Nepali Date Picker -->
    <script src="assets/js/nepali.datepicker.v4.0.1.min.js"></script>
    
    <script type="text/javascript">
            window.onload = function () {
                var mainInput = document.getElementById("nepali-datepicker");
                mainInput.nepaliDatePicker();
            };
    </script>
</html>