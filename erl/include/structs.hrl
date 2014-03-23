
% Очистка протухших блокировок
-define(LOCK_CLEANUP_TIMEOUT,   30000).
-define(LOCK_MAX_TIMEOUT,       60000).
-define(LOCK_MAX_ALIVE_TIMEOUT, 2 * 60000).

% Состояния блокировки
-define(LOCK_STATE_FREE, 0).
-define(LOCK_STATE_BUSY, 1).

%%--------------------------------------------------------------------
%% Блокировка
%%--------------------------------------------------------------------
-record(lock, {
    pid     = false,
    name    = false,
    state   = ?LOCK_STATE_FREE,
    timeout = false,
    release = false,
    created = false
}).