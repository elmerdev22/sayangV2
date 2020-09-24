<div class="card-header">
    <div class="card-title">Transaction History</div>
    <div class="card-tools">
        <!-- Maximize Button -->
        <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
    </div>
</div>
<div class="card-body">
    @livewire('admin.views.accounts.components.user.transaction-history',['key_token' => $user->key_token])
</div>