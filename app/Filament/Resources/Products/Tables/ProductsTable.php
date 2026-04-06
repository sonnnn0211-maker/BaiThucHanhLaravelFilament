<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category'),

                Tables\Columns\TextColumn::make('price')
                    ->formatStateUsing(fn ($state) =>
                        number_format($state, 0, ',', '.') . ' VNĐ'
                    ),

                Tables\Columns\TextColumn::make('stock_quantity'),

                Tables\Columns\ImageColumn::make('image_path'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'out_of_stock' => 'danger',
                    }),

            ])
            ->filters([

                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name'),

            ]);
    }
}