<?php

namespace ElemeOpenApi\Api;

/**
 * 商品服务
 */
class ProductService extends RpcService
{

    /** 上传图片，返回图片的hash值
     * @param $image 文件内容base64编码值
     * @return mixed
     */
    public function upload_image($image)
    {
        return $this->client->call("eleme.file.uploadImage", array("image" => $image));
    }

    /** 通过远程_u_r_l上传图片，返回图片的hash值
     * @param $url 远程Url地址
     * @return mixed
     */
    public function upload_image_with_remote_url($url)
    {
        return $this->client->call("eleme.file.uploadImageWithRemoteUrl", array("url" => $url));
    }

    /** 获取上传文件的访问_u_r_l，返回文件的_url地址
     * @param $hash 图片hash值
     * @return mixed
     */
    public function get_uploaded_url($hash)
    {
        return $this->client->call("eleme.file.getUploadedUrl", array("hash" => $hash));
    }

    /** 获取上传图片的url地址(新版)
     * @param $hash 图片hash值
     * @return mixed
     */
    public function get_image_url($hash)
    {
        return $this->client->call("eleme.file.getImageUrl", array("hash" => $hash));
    }

    /** 查询店铺商品分类
     * @param $shop_id 店铺Id
     * @return mixed
     */
    public function get_shop_categories($shop_id)
    {
        return $this->client->call("eleme.product.category.getShopCategories", array("shopId" => $shop_id));
    }

    /** 查询店铺商品分类，包含二级分类
     * @param $shop_id 店铺Id
     * @return mixed
     */
    public function get_shop_categories_with_children($shop_id)
    {
        return $this->client->call("eleme.product.category.getShopCategoriesWithChildren", array("shopId" => $shop_id));
    }

    /** 查询商品分类详情
     * @param $category_id 商品分类Id
     * @return mixed
     */
    public function get_category($category_id)
    {
        return $this->client->call("eleme.product.category.getCategory", array("categoryId" => $category_id));
    }

    /** 查询商品分类详情，包含二级分类
     * @param $category_id 商品分类Id
     * @return mixed
     */
    public function get_category_with_children($category_id)
    {
        return $this->client->call("eleme.product.category.getCategoryWithChildren", array("categoryId" => $category_id));
    }

    /** 添加商品分类
     * @param $shop_id 店铺Id
     * @param $name 商品分类名称，长度需在50字以内
     * @param $description 商品分类描述，长度需在50字以内
     * @return mixed
     */
    public function create_category($shop_id, $name, $description)
    {
        return $this->client->call("eleme.product.category.createCategory", array("shopId" => $shop_id, "name" => $name, "description" => $description));
    }

    /** 添加商品分类，支持二级分类
     * @param $shop_id 店铺Id
     * @param $name 商品分类名称，长度需在50字以内
     * @param $parent_id 父分类ID，如果没有可以填0
     * @param $description 商品分类描述，长度需在50字以内
     * @return mixed
     */
    public function create_category_with_children($shop_id, $name, $parent_id, $description)
    {
        return $this->client->call("eleme.product.category.createCategoryWithChildren", array("shopId" => $shop_id, "name" => $name, "parentId" => $parent_id, "description" => $description));
    }

    /** 更新商品分类
     * @param $category_id 商品分类Id
     * @param $name 商品分类名称，长度需在50字以内
     * @param $description 商品分类描述，长度需在50字以内
     * @return mixed
     */
    public function update_category($category_id, $name, $description)
    {
        return $this->client->call("eleme.product.category.updateCategory", array("categoryId" => $category_id, "name" => $name, "description" => $description));
    }

    /** 更新商品分类，包含二级分类
     * @param $category_id 商品分类Id
     * @param $name 商品分类名称，长度需在50字以内
     * @param $parent_id 父分类ID，如果没有可以填0
     * @param $description 商品分类描述，长度需在50字以内
     * @return mixed
     */
    public function update_category_with_children($category_id, $name, $parent_id, $description)
    {
        return $this->client->call("eleme.product.category.updateCategoryWithChildren", array("categoryId" => $category_id, "name" => $name, "parentId" => $parent_id, "description" => $description));
    }

    /** 删除商品分类
     * @param $category_id 商品分类Id
     * @return mixed
     */
    public function remove_category($category_id)
    {
        return $this->client->call("eleme.product.category.removeCategory", array("categoryId" => $category_id));
    }

    /** 删除商品分类(新版)
     * @param $category_id 商品分类Id
     * @return mixed
     */
    public function invalid_category($category_id)
    {
        return $this->client->call("eleme.product.category.invalidCategory", array("categoryId" => $category_id));
    }

    /** 设置分类排序
     * @param $shop_id 饿了么店铺Id
     * @param $category_ids 需要排序的分类Id
     * @return mixed
     */
    public function set_category_positions($shop_id, $category_ids)
    {
        return $this->client->call("eleme.product.category.setCategoryPositions", array("shopId" => $shop_id, "categoryIds" => $category_ids));
    }

    /** 设置分类排序(新版)
     * @param $shop_id 饿了么店铺Id
     * @param $category_ids 需要排序的全部一级分类Id
     * @return mixed
     */
    public function set_category_sequence($shop_id, $category_ids)
    {
        return $this->client->call("eleme.product.category.setCategorySequence", array("shopId" => $shop_id, "categoryIds" => $category_ids));
    }

    /** 设置二级分类排序
     * @param $shop_id 饿了么店铺Id
     * @param $category_with_children_ids 需要排序的父分类Id，及其下属的二级分类ID
     * @return mixed
     */
    public function set_category_positions_with_children($shop_id, $category_with_children_ids)
    {
        return $this->client->call("eleme.product.category.setCategoryPositionsWithChildren", array("shopId" => $shop_id, "categoryWithChildrenIds" => $category_with_children_ids));
    }

    /** 查询商品后台类目
     * @param $shop_id 店铺Id
     * @return mixed
     */
    public function get_back_category($shop_id)
    {
        return $this->client->call("eleme.product.category.getBackCategory", array("shopId" => $shop_id));
    }

    /** 设置分类类型
     * @param $shop_id 店铺Id
     * @param $category_id 商品分类Id
     * @param $category_type 分类类型
     * @return mixed
     */
    public function set_category_type($shop_id, $category_id, $category_type)
    {
        return $this->client->call("eleme.product.category.setCategoryType", array("shopId" => $shop_id, "categoryId" => $category_id, "categoryType" => $category_type));
    }

    /** 获取一个分类下的所有商品
     * @param $category_id 商品分类Id
     * @return mixed
     */
    public function get_items_by_category_id($category_id)
    {
        return $this->client->call("eleme.product.item.getItemsByCategoryId", array("categoryId" => $category_id));
    }

    /** 查询商品详情
     * @param $item_id 商品Id
     * @return mixed
     */
    public function get_item($item_id)
    {
        return $this->client->call("eleme.product.item.getItem", array("itemId" => $item_id));
    }

    /** 批量查询商品详情
     * @param $item_ids 商品Id的列表
     * @return mixed
     */
    public function batch_get_items($item_ids)
    {
        return $this->client->call("eleme.product.item.batchGetItems", array("itemIds" => $item_ids));
    }

    /** 添加商品
     * @param $category_id 商品分类Id
     * @param $properties 商品属性
     * @return mixed
     */
    public function create_item($category_id, $properties)
    {
        return $this->client->call("eleme.product.item.createItem", array("categoryId" => $category_id, "properties" => $properties));
    }

    /** 批量添加商品
     * @param $category_id 商品分类Id
     * @param $items 商品属性的列表
     * @return mixed
     */
    public function batch_create_items($category_id, $items)
    {
        return $this->client->call("eleme.product.item.batchCreateItems", array("categoryId" => $category_id, "items" => $items));
    }

    /** 更新商品
     * @param $item_id 商品Id
     * @param $category_id 商品分类Id
     * @param $properties 商品属性
     * @return mixed
     */
    public function update_item($item_id, $category_id, $properties)
    {
        return $this->client->call("eleme.product.item.updateItem", array("itemId" => $item_id, "categoryId" => $category_id, "properties" => $properties));
    }

    /** 批量置满库存
     * @param $spec_ids 商品及商品规格的列表
     * @return mixed
     */
    public function batch_fill_stock($spec_ids)
    {
        return $this->client->call("eleme.product.item.batchFillStock", array("specIds" => $spec_ids));
    }

    /** 批量沽清库存
     * @param $spec_ids 商品及商品规格的列表
     * @return mixed
     */
    public function batch_clear_stock($spec_ids)
    {
        return $this->client->call("eleme.product.item.batchClearStock", array("specIds" => $spec_ids));
    }

    /** 批量上架商品
     * @param $spec_ids 商品及商品规格的列表
     * @return mixed
     */
    public function batch_on_shelf($spec_ids)
    {
        return $this->client->call("eleme.product.item.batchOnShelf", array("specIds" => $spec_ids));
    }

    /** 批量上架商品(新版)
     * @param $item_ids 商品ID列表
     * @return mixed
     */
    public function batch_list_items($item_ids)
    {
        return $this->client->call("eleme.product.item.batchListItems", array("itemIds" => $item_ids));
    }

    /** 批量下架商品
     * @param $spec_ids 商品及商品规格的列表
     * @return mixed
     */
    public function batch_off_shelf($spec_ids)
    {
        return $this->client->call("eleme.product.item.batchOffShelf", array("specIds" => $spec_ids));
    }

    /** 批量下架商品(新版)
     * @param $item_ids 商品ID列表
     * @return mixed
     */
    public function batch_delist_items($item_ids)
    {
        return $this->client->call("eleme.product.item.batchDelistItems", array("itemIds" => $item_ids));
    }

    /** 删除商品
     * @param $item_id 商品Id
     * @return mixed
     */
    public function remove_item($item_id)
    {
        return $this->client->call("eleme.product.item.removeItem", array("itemId" => $item_id));
    }

    /** 删除商品(新版)
     * @param $item_id 商品Id
     * @return mixed
     */
    public function invalid_item($item_id)
    {
        return $this->client->call("eleme.product.item.invalidItem", array("itemId" => $item_id));
    }

    /** 批量删除商品
     * @param $item_ids 商品Id的列表
     * @return mixed
     */
    public function batch_remove_items($item_ids)
    {
        return $this->client->call("eleme.product.item.batchRemoveItems", array("itemIds" => $item_ids));
    }

    /** 批量更新商品库存
     * @param $spec_stocks 商品以及规格库存列表
     * @return mixed
     */
    public function batch_update_spec_stocks($spec_stocks)
    {
        return $this->client->call("eleme.product.item.batchUpdateSpecStocks", array("specStocks" => $spec_stocks));
    }

    /** 批量更新商品库存(新版)
     * @param $stock_map 商品规格ID和库存设值的映射
     * @return mixed
     */
    public function batch_update_stock($stock_map)
    {
        return $this->client->call("eleme.product.item.batchUpdateStock", array("stockMap" => $stock_map));
    }

    /** 设置商品排序
     * @param $category_id 商品分类Id
     * @param $item_ids 商品Id列表
     * @return mixed
     */
    public function set_item_positions($category_id, $item_ids)
    {
        return $this->client->call("eleme.product.item.setItemPositions", array("categoryId" => $category_id, "itemIds" => $item_ids));
    }

    /** 批量沽清库存并在次日2:00开始置满
     * @param $clear_stocks 店铺Id及商品Id的列表
     * @return mixed
     */
    public function clear_and_timing_max_stock($clear_stocks)
    {
        return $this->client->call("eleme.product.item.clearAndTimingMaxStock", array("clearStocks" => $clear_stocks));
    }

    /** 根据商品扩展码获取商品
     * @param $shop_id 店铺Id
     * @param $extend_code 商品扩展码
     * @return mixed
     */
    public function get_item_by_shop_id_and_extend_code($shop_id, $extend_code)
    {
        return $this->client->call("eleme.product.item.getItemByShopIdAndExtendCode", array("shopId" => $shop_id, "extendCode" => $extend_code));
    }

    /** 根据商品条形码获取商品
     * @param $shop_id 店铺Id
     * @param $bar_code 商品条形码
     * @return mixed
     */
    public function get_items_by_shop_id_and_bar_code($shop_id, $bar_code)
    {
        return $this->client->call("eleme.product.item.getItemsByShopIdAndBarCode", array("shopId" => $shop_id, "barCode" => $bar_code));
    }

    /** 批量修改商品价格
     * @param $shop_id 店铺Id
     * @param $spec_prices 商品Id及其下SkuId和价格对应Map(限制最多50个)
     * @return mixed
     */
    public function batch_update_prices($shop_id, $spec_prices)
    {
        return $this->client->call("eleme.product.item.batchUpdatePrices", array("shopId" => $shop_id, "specPrices" => $spec_prices));
    }

    /** 查询活动商品
     * @param $shop_id 店铺Id
     * @return mixed
     */
    public function get_item_ids_has_activity_by_shop_id($shop_id)
    {
        return $this->client->call("eleme.product.item.getItemIdsHasActivityByShopId", array("shopId" => $shop_id));
    }

    /** 查询店铺活动商品(新版)
     * @param $shop_id 店铺Id
     * @return mixed
     */
    public function get_shop_sales_items($shop_id)
    {
        return $this->client->call("eleme.product.item.getShopSalesItems", array("shopId" => $shop_id));
    }

    /** 设置订单餐盒费
     * @param $shop_id  店铺ID
     * @param $status 是否按照订单设置餐盒费
     * @param $packing_fee 订单餐盒费费用
     * @return mixed
     */
    public function set_order_packing_fee($shop_id, $status, $packing_fee)
    {
        return $this->client->call("eleme.product.item.setOrderPackingFee", array("shopId" => $shop_id, "status" => $status, "packingFee" => $packing_fee));
    }

    /** 分页获取店铺下的商品
     * @param $query_page 分页查询参数
     * @return mixed
     */
    public function query_item_by_page($query_page)
    {
        return $this->client->call("eleme.product.item.queryItemByPage", array("queryPage" => $query_page));
    }

    /** 获取原材料树
     * @param $shop_id 店铺ID
     * @return mixed
     */
    public function get_material_tree($shop_id)
    {
        return $this->client->call("eleme.product.item.getMaterialTree", array("shopId" => $shop_id));
    }

}