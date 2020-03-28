<?php
  include_once('header.php');
  include_once('401.php');
?>
    <section id="content">
      <h1 id="title">Users on </h1> <?php include_once('Include/phpUtils/chalkbord.php') ?>
      <div class="users" id="users">
        <form>
              <input type="text" id="searchValue" name="searchValue" value="<?=$_GET["searchValue"] ?? ""?>" 
              autofocus placeholder="Enter search here. . ." onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
              <input type="submit" id="submit" value="Search">
              <br> Orderd by
              <select name="orderBy" id="orderBy"> 
                <option value="username">Username</option>
                
                <?php if ($_GET["orderBy"] == "fullname") {?>
                  <option value="fullname" selected>Fullname</option>
                <?php } else {?>
                  <option value="fullname">Fullname</option>
                
                <?php } if ($_GET["orderBy"] == "signup") {?>
                  <option value="signup" selected>Signup Date</option>
                <?php } else {?>
                  <option value="signup">Signup Date</option>
                <?php } ?>
              </select>

              <input type="checkbox" id="descCheck" name="descCheck" value="DESC"<?=isset($_GET["descCheck"]) ? " checked" : ""?>>
              <label for="descCheck">Descending</label>
          </form>
        <table>
          <tr>
            <th>Username</th>
            <th>Fullname</th>
            <th>Signup Date</th>
          </tr>
          <?php include_once('Include/PDO/getUsertable.php'); ?>
        </table>

      </div>
    </section>

<?php
 include_once('footer.php');
?>
