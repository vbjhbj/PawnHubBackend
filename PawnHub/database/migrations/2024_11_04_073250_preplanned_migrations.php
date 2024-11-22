<?php
 
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
		Schema::dropIfExists('failed_jobs');
		Schema::dropIfExists('password_reset_tokens');
		Schema::dropIfExists('personal_access_tokens');
		Schema::dropIfExists('users');
        Schema::dropIfExists('deletedusers');
		Schema::dropIfExists('shops');
		Schema::dropIfExists('customers');
		Schema::dropIfExists('loans');
		Schema::dropIfExists('transactions');
		Schema::dropIfExists('messages');
		Schema::dropIfExists('categories');
		Schema::dropIfExists('categoryGroups');
		Schema::dropIfExists('items');
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('username');
			$table->string('Password');
			$table->timestamp('lastTransaction')->useCurrent();
			$table->string('taxId');
			$table->string('iban');
			$table->string('imgUrl');
			$table->timestamps();
		});
		Schema::create('shops', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('taxId');
			$table->string('iban');
			$table->string('mobile');
			$table->string('email');
			$table->integer('userId');
			$table->integer('estYear');
			$table->timestamps();
		});
		Schema::create('customers', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('idCardNum');
			$table->timestamp('birthday')->useCurrent();
			$table->timestamp('idCardExp')->useCurrent();
			$table->integer('userId');
			$table->string('bankCardNum');
			$table->string('bankCardExpDate');
			$table->string('bankCardName');
			$table->string('shippingAddress');
			$table->string('billingAddress');
			$table->string('mobile');
			$table->string('email');
			$table->timestamps();
		});
		Schema::create('deletedUsers', function (Blueprint $table) {
			$table->id();
			$table->timestamp('lastTransaction')->useCurrent();
			$table->string('iban');
			$table->string('name');
            $table->timestamps();
        });
		Schema::create('loans', function (Blueprint $table) {
			$table->id();
			$table->foreignId('customerId');
			$table->foreignId('shopId');
			$table->timestamp('startDate')->useCurrent();
			$table->timestamp('expDate')->useCurrent();
			$table->integer('givenAmount');
			$table->float('interest', precision:8);
        });
		
		Schema::create('transactions', function (Blueprint $table) {
			$table->id();
			$table->foreignId('seller');
			$table->foreignId('buyer');
			$table->string('item');
			$table->integer('givenAmount');
        });
		
		Schema::create('messages', function (Blueprint $table) {
			$table->id();
			$table->foreignId('sender');
			$table->foreignId('recipient');
			$table->string('subject');
			$table->string('message');
			$table->timestamps();
        });
		Schema::create('categoryGroups', function (Blueprint $table) {
			$table->id();
			$table->string('name');
        });
		
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->foreignId('groupId');
			$table->string('name');
        });
		Schema::create('items', function (Blueprint $table) {
			$table->id();
			$table->string('imgUrl');
			$table->foreignId('loanId');
			$table->foreignId('shopId');
			$table->foreignId('categoryId');
			$table->integer('value');
        });
		
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('users');
	    Schema::drop('deletedUsers');
    }
};