
<!-- Modal -->
<div class="modal fade" id="deleteTeacher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Teacher</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <h3>Are you sure that you want to delete a teacher?</h3>
          <input type="text" name="remove_value" id="remove_teacher_id">
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btn-remove-teacher" class="btn btn-danger">Save</button>
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>

</div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="assets/js/dashboard.js"></script>
  <script>
    $(document).ready(function(){
      // $('#btn-delete').click(function(){
        
      // });
      $(document).on('click','#btn-delete',function(){
          // console.log($(this).parent('td').parent('tr').find('td').eq(0).text());
          var id = $(this).parent('td').parent('tr').find('td').eq(0).text();
          
          $('#remove_teacher_id').val(id);
      });
    });
  </script>
</body>

</html>