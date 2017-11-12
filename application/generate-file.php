<?php
  // Database conn
  require_once('database-connect.php');
  // File to store the information that will be read by Gephi
  $dataFile = fopen("../gephi/gephi_data.csv", "w+")  ;
  // Select all product lists
  $listSearch = 'SELECT * FROM fbt_lists';
  $resultListSearch = mysqli_query($conn, $listSearch);
  // Browse all playlists
  while($lists = $resultListSearch->fetch_assoc()) {
    // For each list, get products inside it
    $listProducts = 'SELECT * FROM fbt_product_list WHERE fbt_lists_list_id = ' . $lists['list_id'];
    $resultItens = mysqli_query($conn, $listProducts);
    // Array to store products
    $productsArray = Array();
    // Gets the data for each product in the list
    while($listItens = $resultItens->fetch_assoc()) {
      // Get name of product ID
      $nameQuery = 'SELECT * FROM fbt_products WHERE product_id = ' . $listItens['fbt_products_product_id'];
      $resultName = mysqli_query($conn, $nameQuery);
      $nameProduct = $resultName->fetch_assoc()['product_name'];
      // Put name of product in array
      array_push($productsArray, $nameProduct);
    }
    // The algorithm to create a file with the data. The file is in CSV format, and respect de Gephi structure
    for($i = 0; $i < count($productsArray); $i++) {
      for($j = $i+1; $j < count($productsArray); $j++) {
        if($productsArray[$i] != $productsArray[$j]) {
          fwrite($dataFile, $productsArray[$i] . ";" . $productsArray[$j]);
          fwrite($dataFile, "\n\r");
        }
      }
    }
  }
  // Save the file
  fclose($dataFile);
  // Close the connection
  $conn->close();
  // Shows an alert and redirect to index page
  echo "<script>
          alert('Arquivo gerado com sucesso');
          window.location.href='/';
        </script>";
?>
