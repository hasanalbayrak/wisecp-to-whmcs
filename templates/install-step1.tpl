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
        <p>Müşteriler, Para birimleri, destel talepleri, faturalar, faturalanan ürünler, satın alınan hosting, reseller,
            dedicated, vps, satın alınan alan adları aktarılır.</p>
        <form action="" method="post">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">Tablo</th>
                    <th class="text-center">Sayı</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="checkbox" name="clients" value="1"/></td>
                    <td>Müşteri Sayısı</td>
                    <td class="text-center">{$clientcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="currency" value="1"/></td>
                    <td>Para Birimi Sayısı</td>
                    <td class="text-center">{$currencycounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="domains" value="1"/></td>
                    <td>Satın Alınan Alan Adı Sayısı</td>
                    <td class="text-center">{$domaincounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="hosting" value="1"/></td>
                    <td>Satın Alınan Ürün/Hizmet Sayısı</td>
                    <td class="text-center">{$hostingcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="invoices" value="1"/></td>
                    <td>Fatura Sayısı</td>
                    <td class="text-center">{$invoicecounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="invoiceitems" value="1"/></td>
                    <td>Faturalandırılan ürün Sayısı</td>
                    <td class="text-center">{$invoiceitemcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="pricing" value="1"/></td>
                    <td>Fiyatlandırılan ürün Sayısı</td>
                    <td class="text-center">{$pricecounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="products" value="1"/></td>
                    <td>Ürün Sayısı</td>
                    <td class="text-center">{$productcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="servers" value="1"/></td>
                    <td>Sunucu Sayısı</td>
                    <td class="text-center">{$servercounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="ticketdepartments" value="1"/></td>
                    <td>Destek Departman Sayısı</td>
                    <td class="text-center">{$ticketdepartmentcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="tickets" value="1"/></td>
                    <td>Destek Bileti Sayısı</td>
                    <td class="text-center">{$ticketcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="domaintlds" value="1"/></td>
                    <td>Alan Adı Uzantıları Sayısı</td>
                    <td class="text-center">{$tldlistcount}</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" name="ticketreplies" value="1"/></td>
                    <td>Destek Bileti Yanıt Sayısı</td>
                    <td class="text-center">{$ticketrepliescount}</td>
                </tr>
                </tbody>
            </table>
            <div class="text-center">
                <input type="hidden" name="action" value="import_whmcs"/>
                <input type="hidden" name="import_whmcs" value="true"/>
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
