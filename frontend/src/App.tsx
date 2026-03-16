import { useState } from 'react';
import Header from './components/organisms/Header/Header';
import MachineGrid from './components/organisms/MachineGrid/MachineGrid';
import { useMachineSocket } from './hooks/useMachineSocket';

const EMPLOYEES: Record<string, string[]> = {
  Annie: ['Machine A', 'Machine B', 'Machine C'],
  Ben:   ['Machine B', 'Machine C', 'Machine D'],
  Carl:  ['Machine C', 'Machine D', 'Machine E'],
};

const NAMES = Object.keys(EMPLOYEES);

function App() {
  const [userIndex, setUserIndex] = useState(0);
  const username = NAMES[userIndex];
  const machines = useMachineSocket('ws://localhost:8080', username);

  const cycleUser = () => setUserIndex((i) => (i + 1) % NAMES.length);

  const withWatchers = machines.map((m) => ({
    ...m,
    watchers: NAMES.filter((n) => n !== username && EMPLOYEES[n].includes(m.name)),
  }));

  return (
    <div>
      <Header username={username} onUserClick={cycleUser} />
      <MachineGrid machines={withWatchers} />
    </div>
  );
}

export default App;
