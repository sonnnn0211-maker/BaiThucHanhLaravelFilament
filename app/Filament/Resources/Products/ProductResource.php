<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Product;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    // 👉 FORM
    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    // 👉 TABLE
    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
    }

    // 👉 RELATION
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // 👉 PAGES
    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    // 🔥 LOGIC DISCOUNT KHI CREATE
    protected static function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['discount_percent'] ?? 0) > 0) {
            $data['price'] = $data['price'] * (1 - $data['discount_percent'] / 100);
        }

        return $data;
    }

    // 🔥 LOGIC DISCOUNT KHI UPDATE
    protected static function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['discount_percent'] ?? 0) > 0) {
            $data['price'] = $data['price'] * (1 - $data['discount_percent'] / 100);
        }

        return $data;
    }
}