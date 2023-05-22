<div class="table-responsive">
    <table class="table table-striped table-hover table-sm">
        <tr class="table-info">
            <th>Barcode</th>
            <th>Products</th>
            <th>Qty</th>
            <th>Price(in RS)</th>
            <th>Image</th>
            <th>Date</th>
            <th>
                <a href="index.php?pg=product-new">
                    <button class="btn btn-success btn-sm btn-xs"><i class="fa fa-plus"></i> Add New</button>
                </a>
            </th>
        </tr>

        <?php if(!empty($products)) :?>
            <?php foreach($products as $product) :?>
            <tr>
                <td><?=esc($product['barcode'])?></td>
                <td>
                    <a href="index.php?pg=product-single?id=<?=$product['id']?>" class="text-primary">
                        <?=esc($product['description'])?>
                    </a>
                </td>
                <td><?=esc($product['qty'])?></td>
                <td>RS. <?=esc($product['amount'])?></td>
                <td><img src="<?=$product['image']?>" style="width:100%; max-width:100px;"></td>
                <td><?=esc($product['date'])?></td>

                <td>
                    <a href="index.php?pg=product-edit&id=<?=$product['id']?>">
                        <button class="btn btn-warning btn-sm btn-xs me-1"><i class="fa fa-edit"></i></button>
                    </a>
                    
                    <a href="index.php?pg=product-delete&id=<?=$product['id']?>">
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
    </table>

</div>