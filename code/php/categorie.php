<?php
    include('menu.php');
    include('header.php');
    echo '<form>
        <div class="form-row align-items-center">
            <div class="col-auto">
            <label class="sr-only" for="inlineFormInput">Name</label>
            <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Nome catégorie">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-light btn-lg">ajouter</button>
            </div>
        </div>
    </form>';
    echo '<table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">id catégorie</th>
            <th scope="col">nom catégorie</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Larry</td>
        </tr>
        </tbody>
    </table>';

    include('footer.php');
?>