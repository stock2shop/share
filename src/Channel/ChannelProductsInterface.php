<?php

declare(strict_types=1);

namespace Stock2Shop\Share\Channel;

use Stock2Shop\Share\DTO;

/**
 * Methods for interacting (syncing / fetching)
 * product data for a channel.
 */
interface ChannelProductsInterface
{
    /**
     * Syncs a batch of ChannelProducts (DTO) to a channel.
     *
     * ChannelProducts must be persisted (or removed if ChannelProduct->delete=true)
     * to the channel. Regardless of the current state of the channel, after this sync function
     * is called, the channels state should represent the ChannelProducts given.
     *
     * This method should:-
     *
     * - Allow for products to be configured on the channel, based on channel settings (Channel->meta)
     * - Make requests to the channel to update product state on the channel.
     * - Update ChannelProducts success status, marking which products have updated successfully.
     *
     * A ChannelProduct consists of a product with variants and images.
     * The product, variants and images are treated separately and need to be
     * marked as successfully synced independently.
     *
     * Each of the above data classes have the following properties:-
     *
     * - success (did this product update to the channel?)
     * - delete (if true, remove it from the channel)
     *
     * How to define a successful sync for a ChannelProduct?
     *
     * For the product the following properties must be set on ChannelProduct:
     *
     * - ChannelProduct->channel->success = true
     * - ChannelProduct->channel->channel_product_code = "channel's unique id for the product"
     *
     * For the variants the following properties must be set on ChannelProduct:
     *
     * - ChannelProduct->channel->success = true
     * - ChannelProduct->channel->channel_product_code = "channel's unique id for the product"
     * - ChannelProduct->variants[]->channel->success = true
     * - ChannelProduct->variants[]->channel->channel_variant_code = "channel's unique id for the variant"
     *
     * For the images the following properties must be set on ChannelProduct:
     *
     * - ChannelProduct->channel->success = true
     * - ChannelProduct->channel->channel_product_code = "channel's unique id for the product"
     * - ChannelProduct->images[]->channel->success = true
     * - ChannelProduct->images[]->channel->channel_image_code = "channel's unique id for the image"
     *
     */
    public function sync(DTO\ChannelProducts $channelProducts, DTO\Channel $channel): DTO\ChannelProducts;

    /**
     * Verify that products exist on a channel, given their
     * ChannelProduct->channel_product_code (channels unique identifier for the product).
     *
     * To confirm that a product, its variants and images are synced with
     * a channel, set the following properties:-
     *
     * - ChannelProduct->channel->success = true
     * - ChannelProduct->channel->variants[]->success = true
     * - ChannelProduct->channel->images[]->success = true
     *
     * @param DTO\ChannelProducts $channelProducts
     * @param DTO\Channel $channel
     * @return DTO\ChannelProducts
     */
    public function getByCode(DTO\ChannelProducts $channelProducts, DTO\Channel $channel): DTO\ChannelProducts;

    /**
     * Used so we can page through products on a channel and return their unique identifiers.
     * In other words, a way for us to see what exists on a channel.
     *
     * Paging:
     * The results must be sorted by ChannelProduct->channel_product_code ascending.
     * ChannelProduct->channel_product_code is the unique identifier on the channel for the product.
     * We use channel_product_code as a pointer and only products with a
     * greater channel_product_code should be returned.
     *
     * For example, if your channel uses an integer for channel_product_code, and it had 22 products in sequence,
     * then paging would look like this.
     * 1. get('', 10, $channel) -> last product returned has channel_product_code=10
     * 2. get('10', 10, $channel) -> last product returned has channel_product_code=20
     * 3. get('20', 10, $channel) -> last product returned has channel_product_code=22
     * 4. get('22', 10, $channel) -> no more products returned
     *
     * The following properties must be set on the returned ChannelProducts:-
     * - ChannelProduct->channel->channel_product_code
     * - ChannelProduct->variant[]->channel->channel_variant_code
     * - ChannelProduct->variant[]->channel->sku
     *
     * You can optionally set ChannelProduct->images[]->channel_image_code if the image exists.
     *
     * If $channel_product_code is blank, the first products in the ordered list must be returned.
     *
     */
    public function get(string $channel_product_code, int $limit, DTO\Channel $channel): DTO\ChannelProducts;
}
