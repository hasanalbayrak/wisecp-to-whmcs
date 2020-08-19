{include file="header.tpl"}

<div class="container">
    <header>
        <div class="lTable">
            <div class="logo-field">
                <a href="https://wagonn.net/" target="_blank">
                    <div class="logo"></div>
                </a>
            </div>
            <div class="version-field text-right">
                {$version}
            </div>
        </div>
    </header>
    <div class="body-content">
        <h2>İçeri Aktarma</h2>
        <p>Müşteriler, Para birimleri, destel talepleri, faturalar, faturalanan ürünler, satın alınan hosting, reseller, dedicated, vps, satın alınan alan adları aktarılır.</p>
        <table class="table">
            <thead>
            <tr>
                <th>Tablo</th>
                <th class="text-center">Sayı</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Müşteri Sayısı</td>
                <td class="text-center">{$clientcounts}</td>
            </tr>
            <tr>
                <td>Para Birimi Sayısı</td>
                <td class="text-center">{$currencycounts}</td>
            </tr>
            <tr>
                <td>Satın Alınan Alan Adı Sayısı</td>
                <td class="text-center">{$domaincounts}</td>
            </tr>
            <tr>
                <td>Satın Alınan Ürün/Hizmet Sayısı</td>
                <td class="text-center">{$hostingcounts}</td>
            </tr>
            <tr>
                <td>Fatura Sayısı</td>
                <td class="text-center">{$invoicecounts}</td>
            </tr>
            <tr>
                <td>Faturalandırılan ürün Sayısı</td>
                <td class="text-center">{$invoiceitemcounts}</td>
            </tr>
            <tr>
                <td>Fiyatlandırılan ürün Sayısı</td>
                <td class="text-center">{$pricecounts}</td>
            </tr>
            <tr>
                <td>Ürün Sayısı</td>
                <td class="text-center">{$productcounts}</td>
            </tr>
            <tr>
                <td>Sunucu Sayısı</td>
                <td class="text-center">{$servercounts}</td>
            </tr>
            <tr>
                <td>Destek Departman Sayısı</td>
                <td class="text-center">{$ticketdepartmentcounts}</td>
            </tr>
            <tr>
                <td>Destek Bileti Sayısı</td>
                <td class="text-center">{$ticketcounts}</td>
            </tr>
            <tr>
                <td>Alan Adı Uzantıları Sayısı</td>
                <td class="text-center">{$tldlistcount}</td>
            </tr>
            </tbody>
        </table>
        <form action="" method="post">
            <input type="hidden" name="action" value="import_whmcs" />
            <input type="hidden" name="import_whmcs" value="true" />
            <div class="text-center">
                <button type="submit" class="btn btn-lg btn-wgn">
                    İçeri Aktar
                </button>
            </div>
        </form>
    </div>
    <footer>
        <div class="lTable">
            <div>
                Copyright © 2018 - {$currentyear} WAGONN
            </div>
        </div>
    </footer>
</div>

{include file="footer.tpl"}
