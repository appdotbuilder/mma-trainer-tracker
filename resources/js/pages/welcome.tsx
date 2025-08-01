import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

interface Props {
    auth?: {
        user?: {
            id: number;
            name: string;
            email: string;
        };
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="MMA Training Tracker" />
            <div className="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
                {/* Navigation */}
                <nav className="fixed top-0 w-full bg-black/20 backdrop-blur-sm border-b border-white/10 z-50">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="flex justify-between items-center py-4">
                            <div className="flex items-center space-x-2">
                                <div className="w-8 h-8 bg-gradient-to-r from-red-500 to-orange-500 rounded-lg flex items-center justify-center">
                                    <span className="text-white font-bold text-lg">🥊</span>
                                </div>
                                <span className="text-white font-bold text-xl">MMA Tracker</span>
                            </div>
                            <div className="flex items-center space-x-4">
                                {auth?.user ? (
                                    <div className="flex items-center space-x-4">
                                        <span className="text-white/80">Welcome, {auth.user.name}</span>
                                        <Link href="/dashboard">
                                            <Button variant="default" className="bg-red-600 hover:bg-red-700">
                                                Dashboard
                                            </Button>
                                        </Link>
                                    </div>
                                ) : (
                                    <div className="flex items-center space-x-3">
                                        <Link href="/login">
                                            <Button variant="ghost" className="text-white hover:bg-white/10">
                                                Log in
                                            </Button>
                                        </Link>
                                        <Link href="/register">
                                            <Button className="bg-red-600 hover:bg-red-700 text-white">
                                                Sign up
                                            </Button>
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </nav>

                {/* Hero Section */}
                <div className="pt-24 pb-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center">
                            <h1 className="text-5xl md:text-7xl font-bold text-white mb-6">
                                🥊 MMA Training
                                <br />
                                <span className="bg-gradient-to-r from-red-400 to-orange-400 bg-clip-text text-transparent">
                                    Tracker
                                </span>
                            </h1>
                            <p className="text-xl md:text-2xl text-white/80 mb-8 max-w-3xl mx-auto leading-relaxed">
                                The ultimate training companion for MMA fighters. Track your sessions, monitor progress, 
                                manage injuries, and dominate your training regime like never before.
                            </p>
                            <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
                                {auth?.user ? (
                                    <Link href="/dashboard">
                                        <Button size="lg" className="bg-red-600 hover:bg-red-700 text-white px-8 py-3 text-lg">
                                            Go to Dashboard →
                                        </Button>
                                    </Link>
                                ) : (
                                    <>
                                        <Link href="/register">
                                            <Button size="lg" className="bg-red-600 hover:bg-red-700 text-white px-8 py-3 text-lg">
                                                Start Training 🚀
                                            </Button>
                                        </Link>
                                        <Link href="/login">
                                            <Button size="lg" variant="outline" className="border-white/20 text-white hover:bg-white/10 px-8 py-3 text-lg">
                                                Sign In
                                            </Button>
                                        </Link>
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Features Section */}
                <div className="py-16">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center mb-16">
                            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                                Everything You Need to Excel
                            </h2>
                            <p className="text-lg text-white/70 max-w-2xl mx-auto">
                                Professional-grade tools designed specifically for MMA athletes and training enthusiasts
                            </p>
                        </div>

                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">📅</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">Training Blocks</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Create structured training programs with clear goals and timelines
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• Plan multi-week training cycles</li>
                                        <li>• Set specific goals and objectives</li>
                                        <li>• Track block completion rates</li>
                                    </ul>
                                </CardContent>
                            </Card>

                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">💪</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">Session Logging</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Detailed workout tracking with exercise performance metrics
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• Log sets, reps, and weights</li>
                                        <li>• Track session duration</li>
                                        <li>• Multiple training types</li>
                                    </ul>
                                </CardContent>
                            </Card>

                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">🎯</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">MMA Metrics</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Track fight-specific metrics like strikes, takedowns, and heart rate
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• Strike count and accuracy</li>
                                        <li>• Takedown success rates</li>
                                        <li>• Heart rate zone analysis</li>
                                    </ul>
                                </CardContent>
                            </Card>

                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">🏥</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">Injury Management</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Monitor injuries and recovery to train safely and effectively
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• Track injury severity</li>
                                        <li>• Recovery timeline monitoring</li>
                                        <li>• Activity restrictions</li>
                                    </ul>
                                </CardContent>
                            </Card>

                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">📊</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">Progress Analytics</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Visualize your improvement with comprehensive charts and stats
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• Performance trend analysis</li>
                                        <li>• Training volume metrics</li>
                                        <li>• Goal achievement tracking</li>
                                    </ul>
                                </CardContent>
                            </Card>

                            <Card className="bg-white/10 backdrop-blur-sm border-white/20 text-white">
                                <CardHeader>
                                    <div className="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center mb-4">
                                        <span className="text-2xl">⚙️</span>
                                    </div>
                                    <CardTitle className="text-xl text-white">Admin Panel</CardTitle>
                                    <CardDescription className="text-white/70">
                                        Comprehensive management tools for coaches and gym administrators
                                    </CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <ul className="space-y-2 text-white/80">
                                        <li>• User management</li>
                                        <li>• Content administration</li>
                                        <li>• System analytics</li>
                                    </ul>
                                </CardContent>
                            </Card>
                        </div>
                    </div>
                </div>

                {/* CTA Section */}
                <div className="py-16">
                    <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                        <div className="bg-gradient-to-r from-red-600/20 to-orange-600/20 backdrop-blur-sm border border-white/20 rounded-2xl p-8">
                            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                                Ready to Level Up Your Training? 🔥
                            </h2>
                            <p className="text-lg text-white/80 mb-8 max-w-2xl mx-auto">
                                Join thousands of fighters who trust MMA Tracker to optimize their training, 
                                prevent injuries, and achieve peak performance.
                            </p>
                            {!auth?.user && (
                                <div className="flex flex-col sm:flex-row gap-4 justify-center">
                                    <Link href="/register">
                                        <Button size="lg" className="bg-red-600 hover:bg-red-700 text-white px-8 py-3 text-lg">
                                            Get Started Free 🚀
                                        </Button>
                                    </Link>
                                    <Link href="/login">
                                        <Button size="lg" variant="outline" className="border-white/20 text-white hover:bg-white/10 px-8 py-3 text-lg">
                                            Already a member?
                                        </Button>
                                    </Link>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Footer */}
                <footer className="py-8 border-t border-white/10">
                    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div className="text-center text-white/60">
                            <p>&copy; 2024 MMA Training Tracker. Built for fighters, by fighters.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}