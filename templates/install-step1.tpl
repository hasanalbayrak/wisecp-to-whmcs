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
        {if $is_form_posted}
            <h2>Sonuç</h2>
            <p>Yapılan işlem sonucunu gösterir.</p>
            <div class="error_log">
                {$error_log}
            </div>
        {else}
        <h2>Önizleme</h2>
        <p>Aşağıda aktarılabilen verilerin özet bilgisi yer almaktadır. İstediğiniz verileri yanlarındaki seçim ile sisteminize taşıyabilirsiniz.</p>
        <form action="" method="post">
            <table class="table">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"/></th>
                    <th>Tablo</th>
                    <th class="text-center">Veri</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><input type="checkbox" name="clients" value="1"/></td>
                    <td>Müşteriler (tblclients)</td>
                    <td class="text-center">{$clientcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="currency" value="1"/></td>
                    <td>Para Birimleri (tblcurrencies)</td>
                    <td class="text-center">{$currencycounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="domains" value="1"/></td>
                    <td>Satın Alınan Alan Adları (tbldomains)</td>
                    <td class="text-center">{$domaincounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="hosting" value="1"/></td>
                    <td>Satın Alınan Ürün/Hizmet (tblhosting)</td>
                    <td class="text-center">{$hostingcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="invoices" value="1"/></td>
                    <td>Faturalar (tblinvoices)</td>
                    <td class="text-center">{$invoicecounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="invoiceitems" value="1"/></td>
                    <td>Faturalandırılan Ürünler (tblinvoiceitems)</td>
                    <td class="text-center">{$invoiceitemcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="pricing" value="1"/></td>
                    <td>Fiyatlar (tblpricing)</td>
                    <td class="text-center">{$pricecounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="products" value="1"/></td>
                    <td>Ürünler (tblproducts)</td>
                    <td class="text-center">{$productcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="servers" value="1"/></td>
                    <td>Sunucular (tblservers)</td>
                    <td class="text-center">{$servercounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="ticketdepartments" value="1"/></td>
                    <td>Destek Departmanlart (tblticketdepartments)</td>
                    <td class="text-center">{$ticketdepartmentcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="tickets" value="1"/></td>
                    <td>Destek Biletleri (tbltickets)</td>
                    <td class="text-center">{$ticketcounts}</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="domaintlds" value="1"/></td>
                    <td>Alan Adı Uzantıları (tbldomainpricing)</td>
                    <td class="text-center">{$tldlistcount}</td>
                </tr>
                <tr>
                    <td width="1%"><input type="checkbox" name="ticketreplies" value="1"/></td>
                    <td>Destek Bileti Yanıtları (tblticketreplies)</td>
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
        {/if}
    </div>
    <footer>
        <div class="lTable">
            <div>
                Copyright © 2018 - {$currentyear} WAGONN - Software and Design Solutions
            </div>
        </div>
    </footer>
</div>

{include file="footer.tpl"}
