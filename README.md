# Share

Stock2Shop DTOs, Factories and Interfaces

## DTO (Data Transfer Objects)

See [this description](https://martinfowler.com/eaaCatalog/dataTransferObject.html).


## Channel Factory

A channel, or Sales Channel, is a shopping cart (e.g. Shopify, Magento etc..), 
market place or B2B platform for selling products and processing orders.

The channel factory (`/src/Channel`) defines a common interface used to communicate with the channel.


## setup

```
git clone https://github.com/stock2shop/share.git
cd share
composer install
```

## running Tests
```
./vendor/bin/phpunit
```
