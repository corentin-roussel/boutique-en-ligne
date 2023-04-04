<?php
?>

<form action="" method="post">
    <label for="desc">Description</label>
    <textarea name="desc" id="desc" cols="30" rows="10"></textarea>

    <label for="price">Price</label>
    <input type="number" id="price" name="price">

    <label for="image">Image</label>
    <input type="text" name="image" id="image">

    <label for="release-date">Release date</label>
    <input type="date" name="release-date" id="release-date">

    <label for="">Developper</label>
    <input type="text">

    <label for="">Publisher</label>
    <input type="text">

    <label for="category">Category</label>
    <select name="category" id="category">
        <options></options>
    </select>

    <label for="subcategory">Sub-scategory</label>
    <select name="subcategory" id="subcategory"></select>
</form>
