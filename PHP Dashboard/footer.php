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
          <h3>Are you sure to remove this teacher?</h3>
          <input type="hidden" name="remove_value" id="remove_teaceher_id">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="btn-remove-teacher" class="btn btn-primary">Save changes</button>
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
  <script>
    $(document).ready(function(){
      // $('#btn-delete').click(function(){
      //   alert(123);
      // })
      $(document).on('click','#btn-delete',function(){
        // console.log($(this).parent('td').parent('tr').find('td').eq(0).text());
        var id = $(this).parent('td').parent('tr').find('td').eq(0).text();
        $('#remove_teaceher_id').val(id)
      })
    })
  </script>
</body>

</html>