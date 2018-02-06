<div class="jumbotron">
  <fieldset>
    <div class="form-group">
      <label for="exampleInputEmail1">Title</label>
      <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="Book Title" value="<?php if (isset($bookTitle)) echo $bookTitle; ?>">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Description</label>
      <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description of the book"><?php if (isset($bookDescription)) echo $bookDescription; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary"><?php if (isset($book)){
    	echo "Edit Book";
    }else{
    	echo "Add Book";
    } ?></button>
  </fieldset>
</div>
