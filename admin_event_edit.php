<?php require "admin_header.php"; ?>
<style>
  .event {
    width: 100%;
  }

  .event_form {
    margin: 0 auto;
    align-items: center;
    display: flex;
    flex-direction: column;
    width: 20rem;
  }

  .flex {
    display: flex;
  }

  .al-ct {
    align-items: center;
  }

  .event_form input {
    padding: 1rem 2rem;
  }

  .mr-2 {
    margin-right: 2rem;
  }

  .label {
    font-weight: bold;
    font-size: 1.3rem;
  }

  .event__input h2 {
    width: 5rem;
  }

  .event__input {
    margin-top: 1rem;
  }
</style>
<div class="event flex">
  <form action="admin_event_upload.php" method="post" enctype="multipart/form-data" class="event_form">
    <div class="event__input flex al-ct ">
      <h2 class="mr-2 label">Name</h2>
      <input type="text" name="event_name">
    </div>
    <div class="event__input flex al-ct ">
      <h2 class="mr-2 label">Content</h2>
      <input type="text" name="content">
    </div>
    <div class="event__input flex al-ct ">
      <h2 class="mr-2 label">Artist</h2>
      <input type="text" name="artist">
    </div>
    <div class="event__input flex al-ct ">
      <h2 class="mr-2 label">開催</h2>
      <input type="date" name="start">
    </div>
    <div class="event__input flex al-ct ">
      <h2 class="mr-2 label">終了</h2>
      <input type="date" name="end">
    </div>
    <input type="file" name="uploadFile" require>
    <div class="gallery_submit">
      <input type="submit" name="submit" value="Upload" class="gallery_upload">
    </div>
  </form>
</div>
<?php require "footer.php"; ?>