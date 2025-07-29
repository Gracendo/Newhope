@extends('layouts.frontend.user.header')
@section('user_dash')
 <!-- Page Header Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque"> <span></span>Rewards</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('user.rewards')}}">Rewards</a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <!--my rewards page start-->
    <style>
        /* body {
            background: white;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        } */
        .glass-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        }
        .gradient-text {
            background: linear-gradient(45deg, #fb6d02, #ff9500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: bold;
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .reward-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .reward-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        .progress-glow {
            box-shadow: 0 0 20px rgba(251, 109, 2, 0.3);
        }
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .achievement-badge {
            background: linear-gradient(45deg, #ffd700, #ffed4e);
            color: #333;
            border-radius: 50px;
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
        }
        
    </style>
<div class="page-services">
        <div class="container">
            <div class="row">
                <div class="container-fluid p-4">
                    

                    <!-- Current Stats Row -->
                    <div class="row mb-4">
                        <div class="col-md-3 mb-3">
                            <div class="glass-card p-4 text-center text-white pulse-animation">
                                <div class="floating-icon">
                                    <i class="fas fa-coins" style="font-size: 2.5rem; color: #ffd700;"></i>
                                </div>
                                <h3 class="gradient-text mb-1" id="totalPoints">85</h3>
                                <p class="mb-0">Total Points</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="glass-card p-4 text-center text-white">
                                <i class="fas fa-heart" style="font-size: 2.5rem; color: #ff6b6b;"></i>
                                <h3 class="mt-2 mb-1" id="donations">12</h3>
                                <p class="mb-0">Donations</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="glass-card p-4 text-center text-white">
                                <i class="fas fa-hands-helping" style="font-size: 2.5rem; color: #4ecdc4;"></i>
                                <h3 class="mt-2 mb-1" id="volunteering">7</h3>
                                <p class="mb-0">Volunteering</p>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="glass-card p-4 text-center text-white">
                                <i class="fas fa-trophy" style="font-size: 2.5rem; color: #fb6d02;"></i>
                                <h3 class="mt-2 mb-1" id="currentLevel">Level 5</h3>
                                <p class="mb-0">Current Level</p>
                            </div>
                        </div>
                    </div>

                    <!-- Progress to Next Reward -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="glass-card p-4 text-white">
                                <h4 class="mb-3">🎯 Progress to Next Reward</h4>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>85 / 100 Points</span>
                                    <span class="achievement-badge">
                                        <i class="fas fa-gift"></i>
                                        1500 CFA
                                    </span>
                                </div>
                                <div class="progress progress-glow" style="height: 15px;">
                                    <div class="progress-bar" style="width: 85%; background: linear-gradient(90deg, #fb6d02, #ff9500);" role="progressbar"></div>
                                </div>
                                <p class="mt-2 text-center">
                                    <small>🔥 Just 15 more points to unlock your next reward! 
                                    <br>💡 Donate 3 times or volunteer 2 times to reach it!</small>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="glass-card p-4 text-white">
                                <h5 class="mb-3">📊 Monthly Points</h5>
                                <canvas id="monthlyChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="glass-card p-4 text-white">
                                <h5 class="mb-3">🎯 Points Distribution</h5>
                                <canvas id="distributionChart" width="400" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Rewards Timeline -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="glass-card p-4 text-white">
                                <h4 class="mb-4">🎁 Rewards Timeline</h4>
                                <div class="row" id="rewardsTimeline">
                                    <!-- Rewards will be dynamically generated -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Motivational Section -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="glass-card p-4 text-white text-center">
                                <i class="fas fa-rocket" style="font-size: 3rem; color: #fb6d02;"></i>
                                <h5 class="mt-3 mb-2">Keep Going!</h5>
                                <p class="mb-3">You're making a real difference in people's lives!</p>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-light btn-sm">
                                        <i class="fas fa-heart text-danger"></i> Donate Now
                                    </button>
                                    <button class="btn btn-light btn-sm">
                                        <i class="fas fa-hands-helping text-info"></i> Volunteer
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="glass-card p-4 text-white">
                                <h5 class="mb-3">🌟 Recent Achievements</h5>
                                <div class="achievement-badge mb-2">
                                    <i class="fas fa-medal"></i> Generous Heart
                                </div>
                                <p class="small mb-2">Completed 10 donations</p>
                                <div class="achievement-badge mb-2">
                                    <i class="fas fa-star"></i> Helper Hero
                                </div>
                                <p class="small mb-0">5 volunteering sessions completed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
    <script>
        // Initialize data
        const currentPoints = 85;
        const donations = 12;
        const volunteering = 7;

        // Rewards structure
        const rewards = [
            { points: 10, amount: 1000, level: 1, unlocked: true },
            { points: 20, amount: 1000, level: 2, unlocked: true },
            { points: 30, amount: 1000, level: 3, unlocked: true },
            { points: 50, amount: 1500, level: 4, unlocked: true },
            { points: 70, amount: 1500, level: 5, unlocked: true },
            { points: 90, amount: 1500, level: 6, unlocked: false },
            { points: 110, amount: 2000, level: 7, unlocked: false },
            { points: 130, amount: 2000, level: 8, unlocked: false }
        ];

        // Generate rewards timeline
        function generateRewardsTimeline() {
            const timeline = document.getElementById('rewardsTimeline');
            
            rewards.forEach((reward, index) => {
                const isUnlocked = currentPoints >= reward.points;
                const isCurrent = index === rewards.findIndex(r => r.points > currentPoints) - 1;
                
                const card = document.createElement('div');
                card.className = 'col-md-3 mb-3';
                card.innerHTML = `
                    <div class="reward-card glass-card p-3 text-center ${isUnlocked ? 'border-success' : ''}" 
                         style="border: 2px solid ${isUnlocked ? '#28a745' : 'rgba(255,255,255,0.2)'};">
                        <div class="mb-2">
                            ${isUnlocked ? '<i class="fas fa-check-circle text-success" style="font-size: 1.5rem;"></i>' : 
                              '<i class="fas fa-lock text-muted" style="font-size: 1.5rem;"></i>'}
                        </div>
                        <h6 class="gradient-text">Level ${reward.level}</h6>
                        <p class="mb-1"><strong>${reward.points}</strong> Points</p>
                        <div class="achievement-badge" style="font-size: 0.8rem;">
                            ${reward.amount} CFA
                        </div>
                        ${isUnlocked ? '<p class="text-success mt-2 small"><i class="fas fa-trophy"></i> Unlocked!</p>' : 
                          '<p class="text-muted mt-2 small">Keep going!</p>'}
                    </div>
                `;
                timeline.appendChild(card);
            });
        }

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Monthly Points',
                    data: [15, 25, 35, 45, 65, 85],
                    borderColor: '#fb6d02',
                    backgroundColor: 'rgba(251, 109, 2, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            color: 'white'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        ticks: {
                            color: 'white'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    }
                }
            }
        });

        // Distribution Chart
        const distributionCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Donations', 'Volunteering'],
                datasets: [{
                    data: [donations * 5, volunteering * 10],
                    backgroundColor: ['#ff6b6b', '#4ecdc4'],
                    borderColor: ['#ff6b6b', '#4ecdc4'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white'
                        }
                    }
                }
            }
        });

        // Initialize the rewards timeline
        generateRewardsTimeline();

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add click effect to reward cards
            const rewardCards = document.querySelectorAll('.reward-card');
            rewardCards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.95)';
                    setTimeout(() => {
                        this.style.transform = 'scale(1)';
                    }, 150);
                });
            });
        });
    </script>
    @endsection