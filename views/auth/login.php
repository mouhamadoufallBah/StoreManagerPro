<!-- Formulaire classique -->
<form action="http://localhost:8000/auth" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
    <input type="hidden" id="login-role-select" value="admin">

    <div>
        <label style="font-size: 11px; font-weight: 700; color: var(--text-muted); display: block; margin-bottom: 6px; text-transform: uppercase;">Adresse email</label>
        <div style="position: relative;">
            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 14px;">👤</span>
            <input type="email" name="email" id="login-email" class="form-control" value="admin@storemanager.sn" placeholder="vous@boutique.sn" style="width: 100%; padding: 12px 14px 12px 40px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: 10px; color: #ffffff; font-size: 13px;" required>
        </div>
    </div>

    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
            <label style="font-size: 11px; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Mot de passe</label>
            <a href="#" onclick="alert('Mot de passe par défaut : demo1234'); return false;" style="font-size: 11px; font-weight: 600; color: var(--accent); text-decoration: none;">Mot de passe oublié ?</a>
        </div>
        <div style="position: relative;">
            <span style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 14px;">🔒</span>
            <input type="password" name="password" id="login-password" class="form-control" value="demo1234" placeholder="Votre mot de passe" style="width: 100%; padding: 12px 40px 12px 40px; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: 10px; color: #ffffff; font-size: 13px;" required>
            <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 14px; cursor: pointer;">👁️</span>
        </div>
    </div>

    <div style="display: flex; align-items: center; gap: 8px;">
        <input type="checkbox" id="remember-me" checked style="accent-color: var(--accent); width: 16px; height: 16px; cursor: pointer;">
        <label for="remember-me" style="font-size: 12px; color: var(--text-muted); cursor: pointer;">Rester connecté sur cet appareil</label>
    </div>

    <button type="submit" class="btn-submit" style="padding: 14px; font-size: 14px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 8px; box-shadow: 0 10px 25px rgba(45, 212, 191, 0.25);">
        Se connecter ➔
    </button>
</form>