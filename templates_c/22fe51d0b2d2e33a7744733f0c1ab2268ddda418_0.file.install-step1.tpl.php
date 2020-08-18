<?php
/* Smarty version 3.1.36, created on 2020-08-18 23:20:16
  from '/Users/hasanalbayrak/public_html/wisecp-to-whmcs/templates/install-step1.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f3c6230ae92f4_55129922',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22fe51d0b2d2e33a7744733f0c1ab2268ddda418' => 
    array (
      0 => '/Users/hasanalbayrak/public_html/wisecp-to-whmcs/templates/install-step1.tpl',
      1 => 1597792814,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5f3c6230ae92f4_55129922 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="container">
    <header>
        <div class="lTable">
            <div class="logo-field">
                <a href="https://wagonn.net/" target="_blank">
                    <div class="logo"></div>
                </a>
            </div>
            <div class="version-field text-right">
                <?php echo $_smarty_tpl->tpl_vars['version']->value;?>

            </div>
        </div>
    </header>
    <div class="body-content">
        <h2>İçeri Aktarma</h2>
        <p>Müşteriler, Para birimleri, destel talepleri, faturalar, faturalanan ürünler, satın alınan hosting, reseller, dedicated, vps, satın alınan alan adları aktarılır.</p>
        <table>
            <thead>
            <tr>
                <th>Tablo</th>
                <th class="text-center">Sayı</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Müşteri Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['clientcounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Para Birimi Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['currencycounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Satın Alınan Alan Adı Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['domaincounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Satın Alınan Ürün/Hizmet Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['hostingcounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Fatura Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['invoicecounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Faturalandırılan ürün Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['invoiceitemcounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Fiyatlandırılan ürün Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['pricecounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Ürün Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['productcounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Sunucu Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['servercounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Destek Departman Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['ticketdepartmentcounts']->value;?>
</td>
            </tr>
            <tr>
                <td>Destek Bileti Sayısı</td>
                <td class="text-center"><?php echo $_smarty_tpl->tpl_vars['ticketcounts']->value;?>
</td>
            </tr>
            </tbody>
        </table>
        <form action="" method="post">
            <input type="hidden" name="action" value="import_whmcs" />
            <input type="hidden" name="import_whmcs" value="true" />
            <button type="submit" class="btn btn-primary">
                Aktar
            </button>
        </form>
    </div>
    <footer>
        <div class="lTable">
            <div>
                Copyright © 2018 - <?php echo $_smarty_tpl->tpl_vars['currentyear']->value;?>
 WAGONN
            </div>
        </div>
    </footer>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
