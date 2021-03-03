<?php
include './vendor/autoload.php';
$company = new Contributte\Invoice\Data\Company('John Doe', 'Los Angeles', 'Cavetown', '720 55', 'USA', '0123456789', 'CZ0123456789');
$invoice = new Contributte\Invoice\Invoice($company);
$invoice = new Contributte\Invoice\Invoice(Contributte\Invoice\Preview\PreviewFactory::createCompany());

$invoice->send(Contributte\Invoice\Preview\PreviewFactory::createCustomer(), Contributte\Invoice\Preview\PreviewFactory::createOrder());
$company = new Contributte\Invoice\Data\Company('John Doe', 'Los Angeles', 'Cavetown', '720 55', 'USA', '0123456789', 'CZ0123456789');
$account = new Contributte\Invoice\Data\Account('1111', 'CZ4808000000002353462015', 'GIGACZPX');
$payment = new Contributte\Invoice\Data\PaymentInformation('Kč', '0123456789', '1234', 0.21);
$order = new Contributte\Invoice\Data\Order('20160001', new \DateTime('+ 14 days'), $account, $payment);
$order->addItem('Logitech G700s Rechargeable Gaming Mouse', 4, 1790);
$template = new Contributte\Invoice\Templates\DefaultTemplate();

$template->setEven(new Contributte\Invoice\Renderers\Color(0, 0, 0));
$template->setFont(new Contributte\Invoice\Renderers\Color(0, 0, 0));
$template->setEven(new Contributte\Invoice\Renderers\Color(0, 0, 0));
$template->setOdd(new Contributte\Invoice\Renderers\Color(0, 0, 0));

$invoice = new Contributte\Invoice\Invoice($company, $template);

class Translator implements Contributte\Invoice\ITranslator {

    private static $translations = [
        'subscriber' => 'Subscriber',
        'vat' => 'VAT number',
        'vaTin' => 'VATIN',
        'date' => 'Date',
        'invoice' => 'Invoice',
        'invoiceNumber' => 'Invoice number',
        'taxPay' => '',
        'notTax' => 'VAT unregistered',
        'paymentData' => 'Payment information',
        'page' => 'Page',
        'from' => '/',
        'totalPrice' => 'Total price',
        'item' => 'Item',
        'count' => 'Quantity',
        'pricePerItem' => 'Price per item',
        'total' => 'Total',
        'accountNumber' => 'Account number',
        'swift' => 'Swift',
        'iban' => 'Iban',
        'varSymbol' => 'Variable symbol',
        'constSymbol' => 'Constant symbol',
        'tax' => 'TAX',
        'subtotal' => 'Subtotal',
        'dueDate' => 'Due date',
     ];
    
    public function translate(string $message): string {
		return self::$translations[$message];
    }

}
$invoice = new Contributte\Invoice\Invoice($company, new Contributte\Invoice\Templates\DefaultTemplate(new Translator()));
$invoice = new Contributte\Invoice\Invoice($company);

header('Content-Type: application/pdf; charset=utf-8');
echo $invoice->create($customer, $order);
?>