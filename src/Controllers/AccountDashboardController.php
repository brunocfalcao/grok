<?php

namespace Nidavellir\Grok\Controllers;

use App\Http\Controllers\Controller;
use Nidavellir\Thor\Models\Account;

class AccountDashboardController extends Controller
{
    /**
     * Display the dashboard view for the given account UUID.
     *
     * @return \Illuminate\View\View
     */
    public function show(string $uuid)
    {
        // Fetch the account using the UUID
        $account = Account::where('uuid', $uuid)->first();

        if (! $account) {
            abort(404, 'Account not found.');
        }

        // Pass data to the dashboard view
        return view('grok::dashboard.account', [
            'account' => $account,
            'positions' => $account->positions, // Assuming Account has a `positions` relationship
        ]);
    }
}
