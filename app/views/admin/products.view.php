<div class="table-responsive">
    <table class="table table-striped table-hover">
        <tr>
            <th>Barcode</th>
            <th>Products</th>
            <th>Qty</th>
            <th>Price(in RS)</th>
            <th>Image</th>
            <th>Date</th>
            <th>Action</th>
            <th>
                <a href="index.php?pg=product-new">
                    <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                </a>
            </th>
        </tr>

        <?php if(!empty($products)) :?>
            <?php foreach($products as $product) :?>
            <tr>
                <td><?=$product->barcode?></td>
                <td><?=$product->description?></td>
                <td><?=$product->qty?></td>
                <td><?=$product->amount?></td>
                <td>noimage</td>
                <td><?=$product->date?></td>
                <td>
                    <button class="btn btn-primary btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>

</div>