<?php
  // Header
  require_once('header.php');
  require_once('database-connect.php');
  // If the page load is an POST, execute the script below
  if(isset($_POST['submit']))
  {
    // Verify if the ITEM variable exists
    if(isset($_POST['item'])) {
      $itens = $_POST['item'];
      // Creates a record of the new list in the database
      $sqlNewList = "INSERT INTO fbt_lists (list_id) VALUES ('')";
      $resultNewList = mysqli_query($conn, $sqlNewList);
      if($resultNewList === true) {
        // Get the last ID of list recorded in database
        $newListId = $conn->insert_id;
        // Through all of the received item fields in the request
        foreach($itens as $item) {
          // Add record in database
          $sqlNewProd = "INSERT INTO fbt_product_list (fbt_lists_list_id, fbt_products_product_id) VALUES ($newListId, $item)";
          $resultNewProd = mysqli_query($conn, $sqlNewProd);
        }
        echo '<script>alert("Produtos salvos com sucesso")</script>';
      } else {
        echo '<script>alert("Houve um erro, tente novamente")</script>';
      }
    } else {
      echo '<script>alert("Você não enviou nenhum produto")</script>';
    }
  }

  // Get all products recorded in database for the form
  $sqlProducts = "SELECT product_id, product_name FROM fbt_products";
  $resultProducts = mysqli_query($conn, $sqlProducts);
?>

  <div class="section no-pad-bot full-page" id="index-banner">
    <div class="container">
      <h1 class="header center black-text">Criar Lista</h1>
      <div class="row center">
        <h5 class="header col s12 light">Preencha os campos abaixo para criar uma lista de compras</h5>
      </div>
      <div class="row">
        <div class="col s12">
          <form class="create-list"  method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="input-field col s8">
              <select name="prod-select" id="prod-select" required>
                <option value="" disabled selected>Selecione um produto</option>
                <?php
                // Get data from products and put in select field
                if ($resultProducts->num_rows > 0) {
                  while($itemData = $resultProducts->fetch_assoc()) { ?>
                      <option value="<?php echo $itemData['product_id'] ?>"><?php echo $itemData['product_name'] ?></option>
                  <?php }
                }
                ?>
              </select>
              <label for="prod-select">Produtos</label>
            </div>

            <div class="input-field col s4">
              <a href="#" class="waves-effect waves-light btn col s12 black" id="add-item" onclick="addProducts()"><i class="material-icons right">add</i>Adicionar a lista</a>
            </div>

            <div class="row col s12" id="itens">
            </div>

            <div class="row col s12 button-create-list">
              <button class="btn waves-effect waves-light col s12 black" type="submit" name="submit">Check-out
                <i class="material-icons right">send</i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
$conn->close();
require_once('footer.php');
?>
