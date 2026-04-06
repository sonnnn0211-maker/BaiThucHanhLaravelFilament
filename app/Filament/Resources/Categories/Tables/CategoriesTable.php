<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // Tên danh mục (có search)
                Tables\Columns\TextColumn::make('name')
                    ->label('Tên danh mục')
                    ->searchable()
                    ->sortable(),

                // Slug
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->copyable(),

                // Hiển thị hay không
                Tables\Columns\IconColumn::make('is_visible')
                    ->label('Hiển thị')
                    ->boolean(),

                // Ngày tạo (bonus cho đẹp)
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ngày tạo')
                    ->dateTime('d/m/Y H:i'),

            ])

            ->filters([

                // Filter theo is_visible (yêu cầu đề)
                Tables\Filters\TernaryFilter::make('is_visible')
                    ->label('Trạng thái hiển thị'),

            ])

            ->recordActions([
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}