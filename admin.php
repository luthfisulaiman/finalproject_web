<?php
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah</button>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
        		<h4 class="modal-title" id="myModalLabel"> Tambah Buku </h4>
      		</div>
      		<div class="modal-body">
    			<form action="function.php" method="post">
                    <div class="form-group">
                        <label for="cover">Cover Buku</label>
                        <input type="text" class="form-control" id="insert-cover" name="cover" placeholder="Image">
                    </div>
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="insert-judul" name="judul" placeholder="How to Life">
                    </div>
                    <div class="form-group">
                        <label for="penulis">Penulis</label>
                        <input type="text" class="form-control" id="insert-penulis" name="penulis" placeholder="Supreme Gabe Newell">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" class="form-control" id="insert-penerbit" name="penerbit" placeholder="Steam">
                    </div>
                    <div class="form-group">
                        <label for="penerbit">Deskripsi</label>
                        <input type="text" class="form-control" id="insert-deskripsi" name="deskripsi" placeholder="Such book">
                    </div>
                    <div class="form-group">
                    	<label for="stok">Stok</label>
                        <input type="text" class="form-control" id="insert-stok" name="stok" placeholder="1337">
                    </div>
                    <input type="hidden" id="insert-command" name="command" value="insert">
               	</form>
      		</div>
      		<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Submit</button>
      		</div>
    	</div>
  	</div>
</div>