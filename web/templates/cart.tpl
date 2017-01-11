<?php if(stat_cart() != false){ ?>
<div id="products">
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Даннные заказа</h2>
<table>
    <tr>
        <td>№id&nbsp;</td>
        <td>Название</td>
        <td>Количество&nbsp;</td>
        <td>Цена за единицу&nbsp;</td>
        <td>Цена&nbsp;</td>
        <td>Действие&nbsp;</td>

    </tr>
  <?php echo get_prod_in_cart(); ?>
</table>
</div>
<?php }
      else{
        echo "<div id='products'>Корзина пуста</div>";
      }
?>