import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';

interface TrainingBlock {
    id: number;
    name: string;
    description: string;
    start_date: string;
    end_date: string;
    status: string;
    training_sessions: TrainingSession[];
}

interface TrainingSession {
    id: number;
    title: string;
    scheduled_at: string;
    completed_at?: string;
    type: string;
    intensity: string;
    status: string;
    duration_minutes?: number;
    training_block?: TrainingBlock;
    mma_metrics?: {
        strike_count?: number;
        takedowns_successful?: number;
        avg_heart_rate?: number;
    };
}

interface Injury {
    id: number;
    title: string;
    body_part: string;
    severity: string;
    status: string;
    injury_date: string;
}

interface Props {
    activeBlocks: TrainingBlock[];
    upcomingSessions: TrainingSession[];
    recentSessions: TrainingSession[];
    activeInjuries: Injury[];
    stats: {
        totalSessions: number;
        totalTrainingTime: number;
        weeklyStats: {
            sessions: number;
            total_minutes: number;
        };
    };
    [key: string]: unknown;
}

export default function TrainingDashboard({ 
    activeBlocks, 
    upcomingSessions, 
    recentSessions, 
    activeInjuries, 
    stats 
}: Props) {
    const formatDuration = (minutes: number) => {
        const hours = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return hours > 0 ? `${hours}h ${mins}m` : `${mins}m`;
    };

    const getStatusColor = (status: string) => {
        const colors = {
            'active': 'bg-green-100 text-green-800',
            'planned': 'bg-blue-100 text-blue-800',
            'completed': 'bg-gray-100 text-gray-800',
            'scheduled': 'bg-yellow-100 text-yellow-800',
            'in_progress': 'bg-orange-100 text-orange-800',
            'cancelled': 'bg-red-100 text-red-800',
        };
        return colors[status as keyof typeof colors] || 'bg-gray-100 text-gray-800';
    };

    const getIntensityColor = (intensity: string) => {
        const colors = {
            'low': 'bg-green-100 text-green-800',
            'moderate': 'bg-yellow-100 text-yellow-800',
            'high': 'bg-orange-100 text-orange-800',
            'max': 'bg-red-100 text-red-800',
        };
        return colors[intensity as keyof typeof colors] || 'bg-gray-100 text-gray-800';
    };

    return (
        <AppShell>
            <Head title="Training Dashboard" />
            
            <div className="space-y-6">
                {/* Header */}
                <div className="flex justify-between items-center">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900">🥊 Training Dashboard</h1>
                        <p className="text-gray-600 mt-1">Track your MMA training progress and performance</p>
                    </div>
                    <div className="flex space-x-3">
                        <Link href="/training-blocks/create">
                            <Button>Create Training Block</Button>
                        </Link>
                        <Link href="/training-sessions/create">
                            <Button variant="outline">Schedule Session</Button>
                        </Link>
                    </div>
                </div>

                {/* Stats Cards */}
                <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Total Sessions</CardTitle>
                            <span className="text-2xl">💪</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.totalSessions}</div>
                            <p className="text-xs text-muted-foreground">All time</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Training Time</CardTitle>
                            <span className="text-2xl">⏱️</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{formatDuration(stats.totalTrainingTime)}</div>
                            <p className="text-xs text-muted-foreground">Total logged</p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">This Week</CardTitle>
                            <span className="text-2xl">📅</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{stats.weeklyStats?.sessions || 0}</div>
                            <p className="text-xs text-muted-foreground">
                                {formatDuration(stats.weeklyStats?.total_minutes || 0)}
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
                            <CardTitle className="text-sm font-medium">Active Injuries</CardTitle>
                            <span className="text-2xl">🏥</span>
                        </CardHeader>
                        <CardContent>
                            <div className="text-2xl font-bold">{activeInjuries.length}</div>
                            <p className="text-xs text-muted-foreground">Need attention</p>
                        </CardContent>
                    </Card>
                </div>

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    {/* Active Training Blocks */}
                    <Card>
                        <CardHeader>
                            <div className="flex justify-between items-center">
                                <CardTitle className="flex items-center gap-2">
                                    📋 Active Training Blocks
                                </CardTitle>
                                <Link href="/training-blocks">
                                    <Button variant="outline" size="sm">View All</Button>
                                </Link>
                            </div>
                        </CardHeader>
                        <CardContent>
                            {activeBlocks.length > 0 ? (
                                <div className="space-y-4">
                                    {activeBlocks.map((block) => (
                                        <div key={block.id} className="border rounded-lg p-4">
                                            <div className="flex justify-between items-start mb-2">
                                                <Link href={`/training-blocks/${block.id}`} className="hover:text-blue-600">
                                                    <h3 className="font-semibold">{block.name}</h3>
                                                </Link>
                                                <Badge className={getStatusColor(block.status)}>
                                                    {block.status}
                                                </Badge>
                                            </div>
                                            <p className="text-sm text-gray-600 mb-2">
                                                {new Date(block.start_date).toLocaleDateString()} - {new Date(block.end_date).toLocaleDateString()}
                                            </p>
                                            <p className="text-sm text-gray-500">
                                                {block.training_sessions.length} sessions
                                            </p>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">📝</span>
                                    <p>No active training blocks</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    {/* Upcoming Sessions */}
                    <Card>
                        <CardHeader>
                            <div className="flex justify-between items-center">
                                <CardTitle className="flex items-center gap-2">
                                    ⏰ Upcoming Sessions
                                </CardTitle>
                                <Link href="/training-sessions">
                                    <Button variant="outline" size="sm">View All</Button>
                                </Link>
                            </div>
                        </CardHeader>
                        <CardContent>
                            {upcomingSessions.length > 0 ? (
                                <div className="space-y-4">
                                    {upcomingSessions.map((session) => (
                                        <div key={session.id} className="border rounded-lg p-4">
                                            <div className="flex justify-between items-start mb-2">
                                                <Link href={`/training-sessions/${session.id}`} className="hover:text-blue-600">
                                                    <h3 className="font-semibold">{session.title}</h3>
                                                </Link>
                                                <Badge className={getIntensityColor(session.intensity)}>
                                                    {session.intensity}
                                                </Badge>
                                            </div>
                                            <p className="text-sm text-gray-600 mb-1">
                                                {new Date(session.scheduled_at).toLocaleString()}
                                            </p>
                                            <div className="flex justify-between items-center">
                                                <span className="text-sm text-gray-500 capitalize">
                                                    {session.type.replace('_', ' ')}
                                                </span>
                                                <Badge className={getStatusColor(session.status)}>
                                                    {session.status}
                                                </Badge>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">📅</span>
                                    <p>No upcoming sessions</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    {/* Recent Sessions */}
                    <Card>
                        <CardHeader>
                            <CardTitle className="flex items-center gap-2">
                                ✅ Recent Sessions
                            </CardTitle>
                        </CardHeader>
                        <CardContent>
                            {recentSessions.length > 0 ? (
                                <div className="space-y-4">
                                    {recentSessions.map((session) => (
                                        <div key={session.id} className="border rounded-lg p-4">
                                            <div className="flex justify-between items-start mb-2">
                                                <Link href={`/training-sessions/${session.id}`} className="hover:text-blue-600">
                                                    <h3 className="font-semibold">{session.title}</h3>
                                                </Link>
                                                <Badge className="bg-green-100 text-green-800">
                                                    Completed
                                                </Badge>
                                            </div>
                                            <p className="text-sm text-gray-600 mb-2">
                                                {session.completed_at && new Date(session.completed_at).toLocaleDateString()}
                                            </p>
                                            <div className="flex justify-between items-center text-sm">
                                                <span className="text-gray-500">
                                                    {session.duration_minutes && formatDuration(session.duration_minutes)}
                                                </span>
                                                <span className="text-gray-500 capitalize">
                                                    {session.type.replace('_', ' ')}
                                                </span>
                                            </div>
                                            {session.mma_metrics && (
                                                <div className="mt-2 text-xs text-gray-500 space-x-4">
                                                    {session.mma_metrics.strike_count && (
                                                        <span>🥊 {session.mma_metrics.strike_count} strikes</span>
                                                    )}
                                                    {session.mma_metrics.takedowns_successful && (
                                                        <span>🤼 {session.mma_metrics.takedowns_successful} takedowns</span>
                                                    )}
                                                    {session.mma_metrics.avg_heart_rate && (
                                                        <span>❤️ {session.mma_metrics.avg_heart_rate} bpm</span>
                                                    )}
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">🏃</span>
                                    <p>No completed sessions yet</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>

                    {/* Active Injuries */}
                    <Card>
                        <CardHeader>
                            <div className="flex justify-between items-center">
                                <CardTitle className="flex items-center gap-2">
                                    🏥 Active Injuries
                                </CardTitle>
                                <Link href="/injuries">
                                    <Button variant="outline" size="sm">Manage</Button>
                                </Link>
                            </div>
                        </CardHeader>
                        <CardContent>
                            {activeInjuries.length > 0 ? (
                                <div className="space-y-4">
                                    {activeInjuries.map((injury) => (
                                        <div key={injury.id} className="border rounded-lg p-4">
                                            <div className="flex justify-between items-start mb-2">
                                                <h3 className="font-semibold">{injury.title}</h3>
                                                <Badge className={
                                                    injury.severity === 'major' || injury.severity === 'severe' 
                                                        ? 'bg-red-100 text-red-800'
                                                        : injury.severity === 'moderate'
                                                        ? 'bg-yellow-100 text-yellow-800'
                                                        : 'bg-green-100 text-green-800'
                                                }>
                                                    {injury.severity}
                                                </Badge>
                                            </div>
                                            <p className="text-sm text-gray-600 mb-1">
                                                {injury.body_part}
                                            </p>
                                            <p className="text-sm text-gray-500">
                                                Since {new Date(injury.injury_date).toLocaleDateString()}
                                            </p>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">💪</span>
                                    <p>No active injuries</p>
                                    <p className="text-xs">Stay healthy!</p>
                                </div>
                            )}
                        </CardContent>
                    </Card>
                </div>
            </div>
        </AppShell>
    );
}