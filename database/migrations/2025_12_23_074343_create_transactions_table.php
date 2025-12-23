<?php

use App\Enums\TransactionTypeEnum;
use App\Models\Account;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->nullOnDelete();
            $table->date('date');
            $table->string('description');
            $table->text('notes')->nullable();
            $table->enum('transaction_type', TransactionTypeEnum::cases());
            $table->decimal('amount', 12, 2);
            $table->timestamps();

            $table->index('account_id');
            $table->index('category_id');
            $table->index('date');
            $table->index('transaction_type');

            $table->index(['account_id', 'date']);
            $table->index(['account_id', 'transaction_type']);
            $table->index(['account_id', 'category_id']);
            $table->index(['transaction_type', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
