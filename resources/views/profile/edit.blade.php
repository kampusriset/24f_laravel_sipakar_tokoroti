<x-app-layout>
    <style>
        .profile-page {
            min-height: calc(100vh - 4.75rem);
            padding: 1.75rem;
            background:
                radial-gradient(circle at 8% 8%, rgba(230, 148, 69, .14), transparent 20rem),
                linear-gradient(135deg, #fffaf3 0%, #f8efe4 52%, #f6eadc 100%);
            color: #2f2117;
        }

        .profile-wrap {
            width: min(100%, 1080px);
            margin: 0 auto;
        }

        .profile-hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1rem;
            padding: 1.25rem;
            border: 1px solid rgba(133, 91, 58, .16);
            border-radius: 1.1rem;
            background: linear-gradient(135deg, #5f2f14, #9a5424);
            color: #fff8ed;
            box-shadow: 0 18px 45px rgba(91, 54, 28, .14);
        }

        .profile-identity {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .profile-big-avatar {
            display: grid;
            width: 4.25rem;
            height: 4.25rem;
            place-items: center;
            border-radius: 1.15rem;
            background: linear-gradient(135deg, #fff1d7, #e89a4c);
            color: #4b260f;
            font-size: 1.4rem;
            font-weight: 950;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .8), 0 12px 24px rgba(40, 19, 7, .18);
        }

        .profile-kicker {
            margin: 0 0 .3rem;
            color: rgba(255, 248, 237, .72);
            font-size: .75rem;
            font-weight: 950;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .profile-title {
            margin: 0;
            font-size: clamp(1.55rem, 3vw, 2.4rem);
            font-weight: 950;
            line-height: 1;
        }

        .profile-subtitle {
            margin: .35rem 0 0;
            color: rgba(255, 248, 237, .78);
            font-weight: 650;
        }

        .profile-back {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 2.75rem;
            padding: .75rem 1rem;
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: .85rem;
            background: rgba(255, 255, 255, .12);
            color: #fff8ed;
            font-size: .86rem;
            font-weight: 950;
            text-decoration: none;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            gap: 1rem;
        }

        .profile-card {
            padding: 1.25rem;
            border: 1px solid rgba(133, 91, 58, .16);
            border-radius: 1rem;
            background: rgba(255, 255, 255, .9);
            box-shadow: 0 18px 45px rgba(91, 54, 28, .1);
        }

        .profile-card .max-w-xl {
            max-width: 42rem;
        }

        .profile-card h2 {
            color: #2f2117 !important;
            font-weight: 950 !important;
        }

        .profile-card p {
            color: #806d5f !important;
            font-weight: 650;
        }

        .profile-card label {
            color: #4f3828 !important;
            font-weight: 900 !important;
        }

        .profile-card input {
            min-height: 2.9rem;
            border-color: #ead8c4 !important;
            border-radius: .85rem !important;
            background: #fffdf9 !important;
        }

        .profile-card input:focus {
            border-color: #d9843a !important;
            box-shadow: 0 0 0 4px rgba(217, 132, 58, .16) !important;
        }

        .profile-card button[type="submit"],
        .profile-card button:not([type]) {
            border-radius: .8rem !important;
            font-weight: 950 !important;
        }

        @media (max-width: 720px) {
            .profile-page {
                padding: 1rem;
            }

            .profile-hero {
                display: grid;
            }
        }
    </style>

    <div class="profile-page">
        <div class="profile-wrap">
            <section class="profile-hero">
                <div class="profile-identity">
                    <div class="profile-big-avatar">{{ strtoupper(substr($user->name ?? 'K', 0, 1)) }}</div>
                    <div>
                        <p class="profile-kicker">Profil Pengguna</p>
                        <h1 class="profile-title">{{ $user->name }}</h1>
                        <p class="profile-subtitle">{{ $user->email }} · {{ ucfirst($user->role ?? 'kasir') }}</p>
                    </div>
                </div>
                <a href="{{ route('dashboard') }}" class="profile-back">Kembali ke Dashboard</a>
            </section>

            <div class="profile-grid">
                <section class="profile-card">
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section class="profile-card">
                    @include('profile.partials.update-password-form')
                </section>

                <section class="profile-card">
                    @include('profile.partials.delete-user-form')
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
